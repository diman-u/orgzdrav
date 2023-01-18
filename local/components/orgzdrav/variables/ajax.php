<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Orgzdrav\Wellcomes\Models;

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
		if (!empty($master)) {
			return Models\OntCtr::getAll($master);
		}
		
		/**
		 * дополнительная логика для сортировки основного списка
		 */
		$list = Models\OntCtr::getAll('001.150.151.643.01');
		
		foreach ([
			'001.150.151.643.01.45' => 'г.Москва'
		] as $locationId => $title) {
			$list = array_filter($list, function($elem) use ($locationId) {
				return $elem['id'] != $locationId;
			});
			
			array_unshift($list, [
				'id' => $locationId,
				'title' => $title
			]);
		}
		
		return $list;
    }
	
    public function specAction()
    {	
		$cache = \Bitrix\Main\Data\Cache::createInstance();
		
		$cacheTime = 36000000;
		$cacheId = 'variables:spec';
		$cacheDir = 'orgzdrav';
		
		if ($cache->initCache($cacheTime, $cacheId, $cacheDir)) {
			$result = $cache->getVars();
		} elseif ($cache->startDataCache()) {
			$result = Models\OntCmc::getAll();
			$cache->endDataCache($result);
		}
	
		return $result;
    }
}