<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Orgzdrav\WellcomesManager;

class OrgzdravThesaurusAjaxController extends Controller
{
	protected function getDefaultPreFilters()
	{
		return [
			new ActionFilter\Csrf()
		];
	}
	
    public function definitionAction($id)
    {
		$result = WellcomesManager::from('thesaurus')
			->where(['id' => (int) $id])
			->raw();
			
		return [
			'term' => (string) $result->xml->term->value->string,
			'definition' => (string) $result->xml->definition->string,
			'sin' => (string) $result->xml->sin->value->string
		];
    }
}