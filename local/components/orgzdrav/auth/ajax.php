<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Error;
use Bitrix\Main\UserTable;
use Orgzdrav\Validation\Rule\PasswordPolicy;
use Orgzdrav\Wellcomes\Models\User as WellcomesUser;
use Orgzdrav\GeneralUser;

class OrgzdravAuthAjaxController extends Controller
{
	protected function getDefaultPreFilters()
	{
		return [
			new ActionFilter\Csrf(),
			new ActionFilter\HttpMethod(['POST']),
			new \Orgzdrav\ActionFilter\Recaptcha3(
				RECAPTCHA_V3_PRIVATE,
				'auth',
				'token'
			)
		];
	}
	
    public function loginAction($login, $password, $remember = false)
    {
		if ($this->getCurrentUser()->getId()) {
			$this->errorCollection[] = new Error('Вы уже авторизованы');
			return false;
		}
		
		if ('' == trim($login) || '' == trim($password)) {
			$this->errorCollection[] = new Error('Пользовать не найден');
			return false;
		}
		
		if (is_string($remember)) {
			$remember = 'true' === $remember;
		}
		
		if (!GeneralUser::login($login, $password, $remember)) {
			$this->errorCollection[] = new Error('Неверный логин или пароль');
			return false;
		}
		
        return true;
    }
	
    public function resetAction($email)
    {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->errorCollection[] = new Error('Пользовать не найден');
			return false;
		}
		
		$client = new \GuzzleHttp\Client();
		$response = $client->request(
			'POST', 
			'https://id.wellcomes.ru/users/password',
			[
				'json' => [
					'user' => [
						'email' => trim($email),
						'reset_password_callback_url' => 'https://www.orgzdrav.com/'
					]
				]
			]
		);
		
		if ($response->getStatusCode() >= 400) {
			$this->errorCollection[] = new Error('Ошибка отправки сообщения');
			return false;
		}
		
        return true;
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
}