<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Error;
use Bitrix\Main\Loader;

class OrgzdravStatsController extends Controller
{
	protected function getDefaultPreFilters()
	{
		return [
			//new ActionFilter\Csrf()
		];
	}
	
    public function loadAction($elementId)
    {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
		header("Access-Control-Allow-Headers: Content-Type");
		
		Loader::includeModule('iblock');
		
		$iblockId = 22;
		$iblock = \Bitrix\Iblock\Iblock::wakeUp($iblockId);
		$element = $iblock->getEntityDataClass()::getByPrimary($elementId, [
			'select' => ['ID', 'DATA', 'SUBJECTS']
		])->fetchObject();
		
		if (!$element) {
			$this->errorCollection[] = new Error('Элемент не найден');
			return false;
		}
		
		$data = [];
		foreach ($element->getData()->getAll() as $item) {
			$data[] = json_decode($item->getValue());
		}
		
		return [
			'DATA' => $data,
			'SUBJECTS' => json_decode($element->getSubjects()->getValue())
		];
    }
}