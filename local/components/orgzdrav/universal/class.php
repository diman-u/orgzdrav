<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Orgzdrav\Wellcomes\Models\WcsNews;
use Bitrix\Iblock\ElementTable;
use Orgzdrav\Helper\Format;
use Orgzdrav\Wellcomes\EntityModifier;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Loader;

class OrgzdravUniversalComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        if (empty($this->arParams['LIST_ENTITY'])) {
            return false;
        }
		
		Loader::includeModule('iblock');
		
        $this->arResult['ITEMS'] = [];
		$this->fillItems();
		$this->sortItems();
		
        $this->includeComponentTemplate();
    }
	
	private function fillItems()
	{
		$groups = [];
		foreach($this->arParams['LIST_ENTITY'] as $item) {
			if (!is_array($item)) {
				continue;
			}
			
			$groups[$item['TYPE']][] = $item['ID'];
		}
		
		foreach($groups as $type => $ids) {
			switch ($type) {
				case 'iblock':
					$this->fillIBlockElements($ids);
					break;
				case 'wcs_news':
					$this->fillWcsNews($ids);
					break;
				case 'wcs_research':
					$this->fillWcs($ids, '\Orgzdrav\Wellcomes\Models\WcsResearch');
					break;
				default:
					break;
			}
		}
	}
	
	private function fillIBlockElements($ids)
	{
		$res = ElementTable::getList([
			'select' => [
				'ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PREVIEW_TEXT', 'IBLOCK_SECTION_ID', 'DATE_CREATE', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL_RAW' => 'IBLOCK.DETAIL_PAGE_URL'
			],
			'filter' => [
				'ID' => $ids
			]
		]);
		
		while ($item = $res->fetch()) {
			$created = $item['ACTIVE_FROM'] ?? $item['DATE_CREATE'];
			$dateTime = new DateTime($created);

			$this->arResult['ITEMS'][] = [
				'ID' => $item['ID'],
				'TYPE' => 'iblock',
				'ACTIVE_FROM' => Format::getFormatDate($dateTime->getTimestamp()),
				'NAME' => $item['NAME'],
				'PREVIEW_TEXT' => $item['PREVIEW_TEXT'],
				'IMG' => ['SRC' => CFile::getPath($item['PREVIEW_PICTURE'])],
				'ENTITY_CATEGORY' => ENTITY_CATEGORY_TITLE[$item['IBLOCK_ID']],
				'DETAIL_PAGE_URL' => CIBlock::ReplaceDetailUrl($item['DETAIL_PAGE_URL_RAW'], $item, true, "E")
			];
		}
		
		unset($item, $res);
	}
	
	private function fillWcsNews($ids)
	{
		$items = WcsNews::findMany($ids);
		
		$previewTextModifier = new EntityModifier\PreviewText(
			'annotation', 'text', 100
		);
		
		foreach ($items as $item) {	
			if (false !== strpos($item['text'], '&gt;')) {
				$item['text'] = strip_tags(html_entity_decode($item['text']));
			}
			
			$previewTextModifier->modify($item);
			
			$this->arResult['ITEMS'][] = [
                'ID' => $item['id'],
				'TYPE' => 'wcs_news',
                'ACTIVE_FROM' => $item['idx_key_date'] ?? $item['ACTIVE_FROM'],
                'NAME' => $item['header'],
				'PREVIEW_TEXT' => $item['annotation'],
                'IMG' => ['SRC' => $item['photos']['asis']],
                'ENTITY_CATEGORY' => ENTITY_CATEGORY_TITLE[1001],
                'DETAIL_PAGE_URL' => $item['DETAIL_PAGE_URL']
            ];
		}
	}
	
	private function fillWcs($ids, $modelClass)
	{
		$items = $modelClass::findMany($ids);
		
		$previewTextModifier = new EntityModifier\PreviewText(
			'annotation', 'text', 100
		);
		
		foreach ($items as $item) {
			$previewTextModifier->modify($item);
			
			$wcsEntryId = WCS_ENTITY_ID[$item['guide']] ?? 'none';
			
			$item['IMG'] = empty($item['photos']['asis'])
				? false
				: ['SRC' => $item['photos']['asis']];
				
			$item['TYPE'] = $item['guide'];
			$item['ENTITY_CATEGORY'] = ENTITY_CATEGORY_TITLE[$wcsEntryId] ?? '';
			
			$this->arResult['ITEMS'][] = $item;
		}
	}
	
	private function sortItems()
	{
		$orderedItems = [];
		foreach($this->arParams['LIST_ENTITY'] as $item) {
			$found = array_filter($this->arResult['ITEMS'], function($entity) use ($item) {
				return ($entity['ID'] == $item['ID'] && $entity['TYPE'] == $item['TYPE']);
			});
			
			if ($found) {
				$orderedItems[] = array_shift($found);
			}
		}
		
		$this->arResult['ITEMS'] = $orderedItems;
	}
}