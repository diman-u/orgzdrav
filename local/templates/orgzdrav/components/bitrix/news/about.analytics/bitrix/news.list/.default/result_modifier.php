<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['ITEMS'] as &$arItem) {
	$arItem['TARGET'] = '_self';
	
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
		
		//$arItem['DISPLAY_ACTIVE_FROM'] = CFile::FormatSize($arItem['DISPLAY_PROPERTIES']['PDF']['FILE_VALUE']['FILE_SIZE']);
	}
}