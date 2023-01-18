<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Error;

class OrgzdravDocReaderAjaxController extends Controller
{
	protected function getDefaultPreFilters()
	{
		return [
			new ActionFilter\Csrf(),
		];
	}
	
	public function loadAction($id)
	{
		return \Orgzdrav\Wellcomes\Models\Doc::find($id);
		
	}
}