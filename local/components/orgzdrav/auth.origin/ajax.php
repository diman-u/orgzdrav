<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Error;
use Bitrix\Main\Security\Password;
use Bitrix\Main\UserTable;

class OrgzdravAuthAjaxController extends Controller
{
	protected function getDefaultPreFilters()
	{
		return [
			new Csrf(),
		];
	}
	
    public function loginAction($login, $password, $remember = false)
    {
		if ($this->getCurrentUser()->getId()) {
			$this->errorCollection[] = new Error('Вы уже авторизованы');
			return false;
		}
		
		$userData = UserTable::GetRow([
			'filter' => ['=LOGIN' => $login, '=ACTIVE' => 'Y'],
			'select' => ['ID', 'PASSWORD'],
		]);
		
		if (!$userData || !Password::equals($userData['PASSWORD'], $password)) {
			$this->errorCollection[] = new Error('Неверный логин или пароль');
			return false;
		}
		
		/** все ок - авторизация*/
		if (is_string($remember)) {
			$remember = 'true' === $remember;
		}
		
		global $USER;
		$USER->Authorize($userData['ID'], $remember);
		
        return true;
    }
	
    public function resetAction($hash, $password, $password_confirm, $remember = false)
    {
		$errors = $this->_checkPassword($password);
		if ($errors) {
			$this->errorCollection[] = new Error($errors[0]);
			return false;
		}
		
		if ($password != $password_confirm) {
			$this->errorCollection[] = new Error('Пароли не совпадают');
			return false;
		}
		
		if (!\Bitrix\Main\Loader::includeModule('orgzdrav')) {
			$this->errorCollection[] = new Error('Системная ошибка');
			return false;
		}
		
		$record = \Orgzdrav\Tables\UserPassResetTable::getByHash($hash)->fetchObject();
		if (!$record) {
			$this->errorCollection[] = new Error('Ошибка проверки сесиии');
			return false;
		}
		
		/** все ок - смена пароля и авторизация*/
        $userId = $record->getUserId();
		$record->delete();
		
		$user = new \CUser;
		$user->Update($userId, [
			'PASSWORD' => $password, 
			'CONFIRM_PASSWORD' => $password
		]);
		unset($user);
		
		if (is_string($remember)) {
			$remember = 'true' === $remember;
		}
		
		global $USER;
		$USER->Authorize($userId, $remember);
		
        return true;
    }
	
	public function resetSendAction($value, $type = 'email')
    {
		$filter = ['=ACTIVE' => 'Y'];
		
		if ('email' === $type) {
			$filter['=EMAIL'] = trim($value);
		} else {
			$filter['=PERSONAL_PHONE'] = preg_replace('/\D+/', '', $value);
		}
		
		$userData = UserTable::GetRow([
			'filter' => $filter,
			'select' => ['ID', 'EMAIL', 'PERSONAL_PHONE'],
		]);
		
		if (!$userData) {
			$this->errorCollection[] = new Error('Пользовать не найден');
			return false;
		}
		
		/** нашли пользователя */
		\Bitrix\Main\Loader::includeModule('orgzdrav');
		
		$result = \Orgzdrav\Tables\UserPassResetTable::add([
			'user_id' => $userData['ID']
		]);
		
		if (!$result->isSuccess()) {
			$this->errorCollection[] = new Error('Системная ошибка');
			return false;
		}
		
		$resetData = $result->getData();
		if ('email' === $type) {
			$params = [
				'EMAIL' => $userData['EMAIL'],
				'CODE' => $resetData['code']
			];
			\CEvent::SendImmediate('OZ_USER_PASS_RESET', 's1', $params, 'N');
		} else {
			$sms = new \Bitrix\Main\Sms\Event('SMS_USER_RESTORE_PASSWORD', [
				'USER_PHONE' => preg_replace('/\D+/', '', $userData['PERSONAL_PHONE']),
				'CODE' => $resetData['code']
			]);

			$sms->setSite('s1');
			$sms->setLanguage('ru');
			$sms->send();
		}
		
        return true;
    }
	
	public function resetConfirmAction($code)
    {
		if (!\Bitrix\Main\Loader::includeModule('orgzdrav')) {
			$this->errorCollection[] = new Error('Системная ошибка');
			return false;
		}
		
		$record = \Orgzdrav\Tables\UserPassResetTable::getByCode($code)->fetchObject();
		if (!$record) {
			$this->errorCollection[] = new Error('Введенный код не найден');
			return false;
		}
		
        return [
			'hash' => $record->getHash()
		];
    }
	
    public function supportAction($email, $message)
    {
		if (!\Bitrix\Main\Loader::includeModule('form')) {
			$this->errorCollection[] = new Error('Системная ошибка');
			return false;
		}
		
		$formId = 1;
		$values = [
			'form_email_1' => $email,
			'form_textarea_2' => $message
		];
		
		$error = \CForm::Check($formId, $values);
		if ($error) {
			$this->errorCollection[] = new Error($error);
			return false;
		}
		
        $resultId = \CFormResult::Add($formId, $values);
				
		if (!$resultId) {
			$this->errorCollection[] = new Error('Ошибка отправки сообщения');
			return false;
		}
		
		\CFormCRM::onResultAdded($formId, $resultId);
		\CFormResult::SetEvent($resultId);
		\CFormResult::Mail($resultId);
			
		return true;
    }
	
	private function _checkPassword($password)
	{
		$securityPolicy = \CUser::GetGroupPolicy([5]);
		return (new \CUser)->CheckPasswordAgainstPolicy($password, $securityPolicy);
	}

}