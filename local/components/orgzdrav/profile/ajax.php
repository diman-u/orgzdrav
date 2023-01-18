<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\CurrentUser;
use Bitrix\Main\Error;
use Rakit\Validation\Validator;
use Orgzdrav\Validation\Rule\EmailAvaliable;
use Orgzdrav\Validation\Rule\EmailWellcomesAvaliable;
use Orgzdrav\Validation\Rule\PasswordCorrect;
use Orgzdrav\Validation\Rule\PasswordPolicy;
use Orgzdrav\GeneralUser;
use Wellcomes\OAuth2\Client\Provider\Exception\WellcomesIdLockedException;

class OrgzdravProfileController extends Controller
{
	protected function getDefaultPreFilters()
	{
		return [
			new ActionFilter\Csrf(),
			new ActionFilter\HttpMethod(['POST']),
			new ActionFilter\Authentication()
		];
	}
	
	public function updateAction($form)
    {
		/** валидация формы */
		$rules = [
			'NAME' => 'required',
			'LAST_NAME' => 'required',
			'EMAIL' => 'required|email'
		];
		
		$validator = new Validator();
		$validation = $validator->make($form, $rules);
		$validation->setMessages([
			'required' => 'Поле обязательно',
			'EMAIL:email' => 'Указан неверный email',
		]);
		
		$validation->validate();
		
		if ($validation->fails()) {
			$errors = $validation->errors();
			
			foreach ($errors->firstOfAll() as $name => $message) {
				$this->errorCollection[] = new Error($message, 0, $name);
			}
			return false;
		}
		
		unset($form['PERSONAL_PHOTO']);
		
		try {
			GeneralUser::update(CurrentUser::get()->getId(), $form);
		} catch (WellcomesIdLockedException $e) {
			$this->errorCollection[] = new Error('Вы не активировали свою учетную запись Wellcomes ID');
			return false;
		} catch (\Exception $e) {
			$this->errorCollection[] = new Error('Не удалось обновить данные');
			return false;
		}
		
		return true;
	}
	
	public function updateImgAction($clear = false) 
	{
		$currentUser = \CUser::GetByID(CurrentUser::get()->getId())->Fetch();
		
		if (is_string($clear)) {
			$clear = 'true' === $clear;
		}
		
		if (true === $clear) {
			$userpic = [];
			$userpic['del'] = 'Y';           
			$userpic['old_file'] = $currentUser['PERSONAL_PHOTO']; 
		} else {
			/** валидация формы */
			$rules = [
				'userpic' => 'required|uploaded_file:0,4M,png,jpeg',
			];
			
			$validator = new Validator();
			
			$validation = $validator->make($_FILES, $rules);
			$validation->setMessages([
				'required' => 'Поле обязательно',
				'userpic:uploaded_file' => 'Файл должен быть не более :max_size и формата :allowed_types'
			]);
			
			$validation->validate();
			
			if ($validation->fails()) {
				$errors = $validation->errors();
				
				foreach ($errors->firstOfAll() as $name => $message) {
					$this->errorCollection[] = new Error($message);
				}
				return false;
			}
			
			/** все хорошо - обновляем */
			$userpic = $_FILES['userpic'];
			$userpic['old_file'] = $currrentUser['PERSONAL_PHOTO'];
			$userpic['del'] = 'Y';
		}
		
		try {
			GeneralUser::update(CurrentUser::get()->getId(), ['PERSONAL_PHOTO' => $userpic]);
		} catch (\Exception $e) {
			$this->errorCollection[] = new Error('Не удалось обновить данные');
			return false;
		}
		
		/*$user = new CUser;
		
		if (!$user->Update(CurrentUser::get()->getId(), ['PERSONAL_PHOTO' => $userpic])) {
			$this->errorCollection[] = new Error($user->LAST_ERROR);
			return false;
		}*/
		
		return true;
	}
	
	public function changePasswordAction($form)
    {
		/** валидация формы */
		$rules = [
			'PASSWORD' => 'required|passwordCorrect',
			'PASSWORD_NEW' => 'required|min:8|passwordPolicy',
			'PASSWORD_NEW_CONFIRM' => 'required|same:PASSWORD_NEW'
		];
		
		$validator = new Validator([
			'required' => 'Поле обязательно'
		]);
		$validator->addValidator('passwordCorrect', new PasswordCorrect());
		$validator->addValidator('passwordPolicy', new PasswordPolicy());
		
		$validation = $validator->make($form, $rules);
		
		$validation->setMessages([
			'PASSWORD_NEW:min' => 'Пароль должен быть не менее 8-ми символов',
			'PASSWORD_NEW_CONFIRM:same' => 'Пароли не совпадают',
		]);
		
		$validation->validate();
		
		if ($validation->fails()) {
			$errors = $validation->errors();
			
			foreach ($errors->firstOfAll() as $name => $message) {
				$this->errorCollection[] = new Error($message, 0, $name);
			}
			return false;
		}
		
		try {
			GeneralUser::changePassword(
				CurrentUser::get()->getId(),
				$form['PASSWORD'],
				$form['PASSWORD_NEW']
			);
		} catch (WellcomesIdLockedException $e) {
			$this->errorCollection[] = new Error('Вы не активировали свою учетную запись Wellcomes ID');
			return false;
		} catch (\Exception $e) {
			$this->errorCollection[] = new Error('Не удалось обновить пароль');
			return false;
		}
		
		return true;
    }
}