<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;
use Orgzdrav\Helper\Format;
use Bitrix\Main\Type\DateTime;

class OrgzdravSimilarComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $arParams['IBLOCK_ID'] = (int) $arParams['IBLOCK_ID'];
        $arParams['ELEMENT_ID'] = (int) $arParams['ELEMENT_ID'];
		$arParams['SECTION_ID'] = (int) ($arParams['SECTION_ID'] ?? 0);
		$arParams['SORT_BY'] = $arParams['SORT_BY'] ?? 'ID';
		$arParams['LIMIT'] = (int) ($arParams['LIMIT'] ?? 3);

        return $arParams;
    }
	
	public function executeComponent()
    {
		$this->arResult = []; 
		$this->arResult['IDS'] = [];
		$this->arResult['ITEMS'] = [];
		
		if (
			Loader::includeModule('iblock') 
			&& $this->StartResultCache()
		) {
			$filter = [
				'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
				'!ID' => $this->arParams['ELEMENT_ID'],
				'ACTIVE' => 'Y',
			];
			if ($this->arParams['SECTION_ID']) {
				$filter['IBLOCK_SECTION_ID'] = $this->arParams['SECTION_ID'];
			}
			
			$res = \CIBlockElement::GetList(
				[
					$this->arParams['SORT_BY'] => 'DESC'
				], 
				$filter, 
				false, 
				[
					'nTopCount' => $this->arParams['LIMIT']
				], 
				[
					'ID',
					'IBLOCK_ID',
					'NAME',
					'CODE',
					'DETAIL_PAGE_URL',
					'PREVIEW_PICTURE',
					'PREVIEW_TEXT',
					'ACTIVE_FROM',
                    'DATE_CREATE'
				]
			);
			
			while ($ob = $res->GetNextElement()) {

				$element = $ob->GetFields(); 
				$element['PROPERTIES'] = $ob->GetProperties();
				
				$this->arResult['IDS'][] = $element['ID'];
                $created = $element['ACTIVE_FROM'] ?? $element['DATE_CREATE'];
                $dateTime = new DateTime($created);
                $element['ACTIVE_FROM'] = Format::getFormatDate($dateTime->getTimestamp());
                $element['ENTITY_CATEGORY'] = ENTITY_CATEGORY_TITLE[$element['IBLOCK_ID']];
                $element['IMG'] = ['SRC' => CFile::getPath($element['PREVIEW_PICTURE'])];
				$this->arResult['ITEMS'][] = $element;
			}
			
			unset($res, $ob);
			
			
			$this->SetResultCacheKeys([
				'IDS'
			]);
			
			$this->IncludeComponentTemplate();
		}
	}
}