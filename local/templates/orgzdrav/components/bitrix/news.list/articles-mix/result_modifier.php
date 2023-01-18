<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$client = new \Orgzdrav\Gate22\VshouzClient();
$result = $client->list(22);

$obParser = new CTextParser;
$imgAssign = new \Orgzdrav\ImageAssign('/images/demo/');

foreach ($result as $key => $item) {
	if ($arParams['NEWS_COUNT'] <= count($arResult['ITEMS'])) {
		break;
	}
	
	$parentKey = ((int) $arParams['PARENT_SECTION'] % 10);
	if ($parentKey != ($key % 10)) {
		continue;
	}
	
	$item['DISPLAY_ACTIVE_FROM'] = FormatDate($arParams['ACTIVE_DATE_FORMAT'], strtotime($item['DATE_CREATE']));
	$item['PREVIEW_PICTURE']['SRC'] = $imgAssign->getById($item['ID']);
	$item['PREVIEW_TEXT'] = $obParser->html_cut($item['PREVIEW_TEXT'], 100);
	$item['DETAIL_PAGE_URL'] = str_replace(['#SECTION_CODE#', '#ELEMENT_ID#'], [$arParams['PARENT_SECTION_CODE'], $item['ID']], $arParams['DETAIL_URL']);
	
	$arResult['ITEMS'][] = $item;
}

if (!empty($arParams['CHECK_SECTION_DESCRIPTION']) && !empty($arResult['SECTION']['PATH'][0]['DESCRIPTION'])) {
	$this->__component->arResult['SECTION_DESCRIPTION'] = $arResult['SECTION']['PATH'][0]['~DESCRIPTION'];
	$this->__component->SetResultCacheKeys(['SECTION_DESCRIPTION']);
}

// $arParams['NEWS_COUNT'];
//echo '<pre>',var_export($arParams),'<pre>';