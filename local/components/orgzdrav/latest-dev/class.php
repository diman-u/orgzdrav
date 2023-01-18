<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;
use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\ElementPropertyTable;
use Bitrix\Iblock\IblockElementProperty;
use Orgzdrav\WellcomesManager;
use Exception;

class OrgzdravLatestComponent extends \CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
    {
		$arParams['LIMIT'] = intval($arParams['LIMIT'] ?? 5);
		$arParams['UNIVERSAL_TEMPLATE'] = $arParams['UNIVERSAL_TEMPLATE'] ?? 'small';
		
		$arParams['CACHE_TYPE'] = $arParams['CACHE_TYPE'] ?? 'Y';
		$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME'] ?? 3600);

        return $arParams;
    }
	
	public function executeComponent()
    {
		$this->arResult['ITEMS'] = [];
		
        if ($this->StartResultCache()) {
			$list = [];
			
			if (!empty($this->arParams['IBLOCK_IDS'])) {
				$list = $this->fillWithIblock();
			}
            if (!empty($this->arParams['WCS_GUIDES'])) {
				$list = array_merge($list, $this->fillWithWellcomes());
			}
			
			usort($list, function($a, $b) {
				return $b['DATE_CREATE']->getTimestamp() <=> $a['DATE_CREATE']->getTimestamp();
			});
			
			$this->arResult['ITEMS'] = array_slice($list, 0, $this->arParams['LIMIT']);
			
			$this->SetResultCacheKeys([
				'ITEMS'
			]);	
			
			if (empty($this->arResult['ITEMS'])) {
				$this->AbortResultCache();
			}
		
			$this->IncludeComponentTemplate();
        }	
    }
	
	private function fillWithIblock()
	{
		if (!Loader::includeModule('iblock')) {
			return [];
		}
		
		$list = [];
		
		$limit = intval($this->arParams['LIMIT']);
		if (!empty($this->arParams['IBLOCK_STATUS'])) {
			$limit *= count($this->arParams['IBLOCK_STATUS']);
		}
		
		$res = ElementTable::getList([
			'order' => ['DATE_CREATE' => 'DESC'],
			'select' => ['ID', 'IBLOCK_ID', 'DATE_CREATE'],
			'filter' => [
				'IBLOCK_ID' => $this->arParams['IBLOCK_IDS']
			],
			'limit' => $limit
		]);

		while ($row = $res->fetch()) {
			if (!empty($this->arParams['IBLOCK_STATUS'][$row['IBLOCK_ID']])) {
				$prop = ElementPropertyTable::getList([
					"select" => ['ID', 'VALUE'],
					"filter" => [
						'IBLOCK_ELEMENT_ID' => $row['ID'],
						'IBLOCK_PROPERTY_ID' => $this->arParams['IBLOCK_STATUS'][$row['IBLOCK_ID']]
					],
				])->fetch();
				
				if (!$prop || empty($prop['VALUE'])) {
					continue;
				}
			}
			
			
			$row['TYPE'] = 'iblock';
			$list[] = $row;
		}
		unset($row, $row);
		
		return $list;
	}
	
	private function fillWithWellcomes()
	{
		$list = [];
		
		foreach ($this->arParams['WCS_GUIDES'] as $guide) {
			$config = WellcomesManager::config($guide);
			
			try {
				$builder = WellcomesManager::from($guide);
				$builder
					->select(['idx_key_date'])
					->where($config['FILTER'])
					->limit($this->arParams['LIMIT'])
					->orderBy('idx_key_date', 'dec');
				
				$result = $builder->raw();
				
				foreach ($result->xml->list->children() as $node) {
					$timestamp = strtotime($node->xpath('./field[@id="idx_key_date"]')[0]->__toString());
					
					$list[] = [
						'ID' => (string) $node['id'],
						'TYPE' => $guide,
						'DATE_CREATE' => DateTime::createFromTimestamp($timestamp)
					];
				}
				unset($config, $builder, $result);
			} catch (Exception $e) {}
		}
		
		return $list;
	}
}