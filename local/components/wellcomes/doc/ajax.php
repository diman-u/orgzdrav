<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Error;
use Bitrix\Main\Data\Cache;

class WellcomesDocAjaxController extends Controller
{
	protected function getDefaultPreFilters()
	{
		return [
			new ActionFilter\Csrf(),
		];
	}
	
	public function menuAction($id)
	{
		$cache = Cache::createInstance();
		if ($cache->initCache(7200, 'wellcomes:doc:menu:'.$id)) {
			return $cache->getVars();
		}
		
		try {
			$doc = \Orgzdrav\Wellcomes\Models\Doc::find($id);
			
			$cache->startDataCache();
			
			$menu = [];
			
			foreach ($doc['body'] as $element) {
				if ('section' != $element['type']) {
					continue;
				}
				if (empty($element['id']) || empty($element['value']['head'])) {
					continue;
				}
				
				$menu[$element['id']] = preg_replace('/^[. 0-9]+/', '', $element['value']['head']);
			}
			
			$cache->endDataCache($menu);	
			
			return $menu;
		} catch (\Exception $e) {
			$this->errorCollection[] = new Error('doc not found');
			return false;
		}
	}
}