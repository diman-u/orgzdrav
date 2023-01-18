<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult['ITEMS'] = [];
$arResult['TOP_ITEMS'] = [];

foreach ($arResult["IBLOCKS"] as $arIBlock) {
	foreach($arIBlock["ITEMS"] as $arItem) {
		$resultKey = 'ITEMS';
		
		$arItem['TARGET'] = '_self';
		$arItem['ACTIVE_FROM_TS'] = strtotime($arItem['ACTIVE_FROM']);
		
		switch ($arItem['IBLOCK_ID']) {
			case 29:
				$arItem['META_TAG'] = 'Выступления';
				
				if (
					!empty($arItem['PREVIEW_PICTURE']['SRC'])
					&& 2 > count($arResult['TOP_ITEMS'])
				) {
					$resultKey = 'TOP_ITEMS';
				}
				break;
			case 30:
				$arItem['META_TAG'] = 'Аналитика';
				
				if (
					empty($arItem['PREVIEW_PICTURE']['SRC'])
					&& !empty($arItem['DISPLAY_PROPERTIES']['PDF_TYPE']['VALUE_XML_ID'])
				) {
					$arItem['PREVIEW_PICTURE'] = [
						'SRC' => sprintf('/images/about/icon-%s.png', $arItem['DISPLAY_PROPERTIES']['PDF_TYPE']['VALUE_XML_ID'])
					];
				}
				
				if (
					empty($arItem['DETAIL_TEXT'])
					&& !empty($arItem['DISPLAY_PROPERTIES']['PDF']['FILE_VALUE']['SRC'])
				) {
					$arItem['TARGET'] = '_blank';
					$arItem['DETAIL_PAGE_URL'] = $arItem['DISPLAY_PROPERTIES']['PDF']['FILE_VALUE']['SRC'];
				}
				break;
			default:
				break;
		}
		
		$arResult[$resultKey][] = $arItem;
	}
}

usort($arResult['ITEMS'], function ($a, $b) {
	return $b['ACTIVE_FROM_TS'] <=> $a['ACTIVE_FROM_TS'];
});