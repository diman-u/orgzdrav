<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Orgzdrav\Wellcomes\Models\OntCtr;

class OrgzdravGeoAjaxController extends Controller
{
	protected function getDefaultPreFilters()
	{
		return [
			new ActionFilter\Csrf()
		];
	}
	
    public function locationsAction($master = '')
    {
		if (empty($master)) {
			$master = '001.150.151.643.01';
		}
			
		return OntCtr::getAll($master);
    }
}