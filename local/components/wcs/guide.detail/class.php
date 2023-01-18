<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Orgzdrav\CrawlerDetect;
use Orgzdrav\Tables\AnonymousCounterTable;
use Orgzdrav\Tables\ViewCounterTable;

class WcsDetailComponent extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $arParams['GUIDE'] = $arParams['GUIDE'] ?: false;
        $arParams['ENTITY_ID'] = $arParams['ENTITY_ID'] ?: false;
		$arParams['FULL_ACCESS'] = $arParams['FULL_ACCESS'] ?: false;
		$arParams['TITLE'] = $arParams['TITLE'] ?: 'header';

        return $arParams;
    }
	
	public function executeComponent()
    {
		if (0 === strpos($this->arParams['GUIDE'], 'vshouz')) {
			$this->prepareDataVshouz();
		} else {
			$this->prepareData();
		}
		
		$this->includeComponentTemplate();
    }

    public function prepareData()
    {
		global $APPLICATION;
		
		$this->arResult = [];
		
		$client = new \Orgzdrav\Gate22\WellcomesClient('orgzdrav', 'test');
		$entity = new \Orgzdrav\Gate22\WellcomesEntity($client);
		
		$this->arResult = $entity->load($this->arParams['GUIDE'], $this->arParams['ENTITY_ID']);
		
		if (!empty($this->arParams['TITLE']) && array_key_exists($this->arParams['TITLE'], $this->arResult)) {
			$title = $this->arResult[$this->arParams['TITLE']]['value'];
			
			if ($this->arParams['USE_COUNTER']) {
				$this->arResult['view_counter'] = ViewCounterTable::getCurrentCountAndInc($this->arParams['GUIDE'], $this->arParams['ENTITY_ID']);
			}
			
			
			$APPLICATION->setTitle($title);
			$APPLICATION->AddChainItem($title);
		}
    }

    public function prepareDataVshouz()
    {
		global $APPLICATION;
		
		$client = new \Orgzdrav\Gate22\VshouzClient();
		
		$iblockId = array_pop(explode(':', $this->arParams['GUIDE']));
        $result = $client->item($this->arParams['ENTITY_ID']);
		
		
		$this->arResult = [];
		
		$this->arResult['id'] = $result['ID'];
		$this->arResult['idx_key_date'] = $result['ACTIVE_FROM'] ?? $result['DATE_CREATE'];
		$this->arResult['header']['value'] = $result['NAME'];
		$this->arResult['photos']['asis'] = $result['DETAIL_PICTURE'] ?? $result['PREVIEW_PICTURE'];
		$this->arResult['preamble']['value'] = '';
		$this->arResult['text']['value'] = $result['~DETAIL_TEXT'];
		$this->arResult['text']['value'] = str_replace('src="/', 'src="https://www.vshouz.ru/', $this->arResult['text']['value']);
			
		foreach ($result['PROPERTIES'] as $key => $value) {
			$this->arResult[strtolower($key)]['value'] = $value;
		}
			
		/*if ($this->arParams['USE_COUNTER']) {
			$this->arResult['view_counter'] = ViewCounterTable::getCurrentCountAndInc($this->arParams['GUIDE'], $this->arParams['ENTITY_ID']);
		}*/
		
		$APPLICATION->setTitle($result['NAME']);
		$APPLICATION->AddChainItem($result['NAME']);
    }
}