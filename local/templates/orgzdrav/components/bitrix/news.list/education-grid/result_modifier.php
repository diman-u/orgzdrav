<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['ITEMS'] as &$arItem) {
	$arItem['CURRENT_DATE'] = '';
	$arItem['CURRENT_PRICE'] = '';
	
	foreach ($arItem['DISPLAY_PROPERTIES']['price']['VALUE'] as $i => $value) {
		$value = explode('|', $value);
		$value = array_map('trim', $value);
		
		$arItem['CURRENT_DATE'] = $value[0];
		$arItem['CURRENT_PRICE'] = $arItem['DISPLAY_PROPERTIES']['price']['DESCRIPTION'][$i];
		break;
	}
	
	if (!empty($arItem['DISPLAY_PROPERTIES']['custom_date']['VALUE'])) {
		$arItem['CURRENT_DATE'] = $arItem['DISPLAY_PROPERTIES']['custom_date']['VALUE'];
	}	
	if (1 < count($arItem['DISPLAY_PROPERTIES']['price']['VALUE'])) {
		$arItem['CURRENT_PRICE'] = 'от ' . str_replace('от ', '', $arItem['CURRENT_PRICE']);
	}
}