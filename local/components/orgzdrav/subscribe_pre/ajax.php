<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Error;
use Rakit\Validation\Validator;
use Orgzdrav\Tables\SubscribesTable;

class OrgzdravSubscribePreAjaxController extends Controller
{
	protected function getDefaultPreFilters()
	{
		return [
			new ActionFilter\Csrf(),
			new ActionFilter\HttpMethod(['POST']),
			new \Orgzdrav\ActionFilter\Recaptcha3(
				RECAPTCHA_V3_PRIVATE,
				'subscribe_pre',
				'token'
			)
		];
	}
	
    public function subscribeAction($fields)
    {
		$rules = [
			'name' => 'required',
			'email' => 'required|email',
			'organization' => 'required'
		];
		
		$validator = new Validator([
			'required' => 'Поле обязательно',
			'email' => 'Указан неверный email'
		]);
		
		$validation = $validator->make($fields, $rules);
		$validation->validate();
		
		if ($validation->fails()) {
			$errors = $validation->errors();
			
			foreach ($errors->firstOfAll() as $name => $message) {
				$this->errorCollection[] = new Error($message, 0, $name);
			}
			return false;
		}
		
		SubscribesTable::add([
			'fio' => $fields['name'],
			'email' => $fields['email'],
			'organization' => $fields['organization'],
			'organization_dadata_id' => $fields['organization_dadata_id'] ?? '',
			'created_at' => new \Bitrix\Main\Type\DateTime()
		]);
		
		\Orgzdrav\Helper\SendPulse::subscribe($fields['email'], [
			'fio' => $fields['name'],
			'organization' => $fields['organization']
		]);
		
        return true;
    }
}