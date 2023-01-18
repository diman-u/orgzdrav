<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Error;
use Rakit\Validation\Validator;
use Orgzdrav\Validation\Rule\EmailAvaliable;
use Orgzdrav\Validation\Rule\WellcomesId;
use Orgzdrav\Validation\Rule\PasswordPolicy;
use Orgzdrav\GeneralUser;

class OrgzdravRegistrationController extends Controller
{
	protected function getDefaultPreFilters()
	{
		return [
			new ActionFilter\Csrf(),
			new ActionFilter\HttpMethod(['POST']),
			new \Orgzdrav\ActionFilter\Recaptcha3(
				RECAPTCHA_V3_PRIVATE,
				'registration',
				'token'
			)
		];
	}
	
	public function registrationAction($form, $remember = false)
    {
		if (!$this->validateUserFieldsAction($form, false)) {
			return false;
		}
		
		if (is_string($remember)) {
			$remember = 'true' === $remember;
		}
		
		try {
			$userId = GeneralUser::register($form);
			
			$event = new \CEvent;
			$event->SendImmediate('ORGZDRAV_USER_INFO', SITE_ID, $form);
			
			global $USER;
			$USER->Authorize($userId, $remember);
		} catch (\Exception $e) {
			$this->errorCollection[] = new Error('Не удалось зарегистрировать аккаунт!');
			return false;
		}
		
		return true;
	}
	
	/** validators */
	public function validateUserFieldsAction($fields, $limit = true)
	{
		$rules = [
			'NAME' => 'required|min:3',
			'SECOND_NAME' => 'nullable|min:3',
			'LAST_NAME' => 'required|min:3',
			'EMAIL' => 'required|email|emailAvaliable|emailWellcomesId',
			'PERSONAL_PHONE' => 'required|phoneWellcomesId',
			
			'PERSONAL_PROFESSION' => 'required',
			'WORK_COMPANY' => 'required',
			'WORK_POSITION' => 'required',
			'WORK_STATE' => 'required',
			
			'PASSWORD' => 'required|min:8|passwordPolicy',
			'PASSWORD_CONFIRM' => 'required|same:PASSWORD'
		];
		
		if (true === $limit) {
			$rules = array_intersect_key($rules, $fields);
		}
		
		$validator = new Validator([
			'required' => 'Поле обязательно'
		]);
		
		$validator->addValidator('emailAvaliable', new EmailAvaliable());
		$validator->addValidator('emailWellcomesId', new WellcomesId('email'));
		$validator->addValidator('phoneWellcomesId', new WellcomesId('phone_personal'));
		$validator->addValidator('passwordPolicy', new PasswordPolicy());
		
		$validation = $validator->make($fields, $rules);
		$validation->setMessages([
			'NAME:min' => 'Слишком короткое имя',
			'SECOND_NAME:min' => 'Слишком короткое отчество',
			'LAST_NAME:min' => 'Слишком короткая фамилия',
			'EMAIL:email' => 'Указан неверный email',
			'PASSWORD:min' => 'Пароль должен быть не менее 8-ми символов',
			'PASSWORD_CONFIRM:same' => 'Пароли не совпадают'
		]);
		
		$validation->validate();
		
		if ($validation->fails()) {
			$errors = $validation->errors();
			
			foreach ($errors->firstOfAll() as $name => $message) {
				$this->errorCollection[] = new Error($message, 0, $name);
			}
			return false;
		}
		
		return true;
	}
}