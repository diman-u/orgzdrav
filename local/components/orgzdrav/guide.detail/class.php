<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Orgzdrav\CrawlerDetect;
use Orgzdrav\Tables\AnonymousCounterTable;

class OrgzdravDemoListComponent extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $arParams['GUIDE'] = $arParams['GUIDE'] ?: false;
        $arParams['ENTITY_ID'] = $arParams['ENTITY_ID'] ?: false;
		$arParams['FULL_ACCESS'] = $arParams['FULL_ACCESS'] ?: false;

        return $arParams;
    }
	
	public function executeComponent()
    {
		$this->prepareData();
		$this->includeComponentTemplate();
    }

    public function prepareData()
    {
		global $APPLICATION;
		
		$this->arResult = [];
		
		$client = new \Orgzdrav\Gate22\WellcomesClient('orgzdrav', 'test');
		$entity = new \Orgzdrav\Gate22\WellcomesEntity($client);
		
		$result = $entity->load($this->arParams['GUIDE'], $this->arParams['ENTITY_ID']);
		
		$APPLICATION->setTitle($result['dnt']['value']);
		$this->arResult = $result;
    }
}