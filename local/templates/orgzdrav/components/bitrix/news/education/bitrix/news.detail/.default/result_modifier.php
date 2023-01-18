<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponent $component */
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */


$this->__component->setResultCacheKeys(['HAS_GALLERY', 'PRICES']);

$arResult['PRICES'] = [];
$arResult['CURRENT_DATE'] = '';

foreach ($arResult['DISPLAY_PROPERTIES']['price']['VALUE'] as $i => $value) {
	$value = explode('|', $value);
	$value = array_map('trim', $value);
	
	$arResult['PRICES'][] = [
		'id' => $i,
		'title' => $value[0],
		'subtitle' => $value[1] ?? '',
		'sum' => $arResult['DISPLAY_PROPERTIES']['price']['DESCRIPTION'][$i]
	];
	
	if (empty($arResult['CURRENT_DATE'])) {
		$arResult['CURRENT_DATE'] = $value[0];
	}
}

/**
 * Спикеры
 */
$arrSpeakers = $arResult['PROPERTIES']['LEKTORS']['VALUE'];

$iblockId = 18;
$speakers = [];

if (CModule::IncludeModule("iblock")) {
    $arSort = ['SORT' => 'ASC', 'ID' => 'ASC'];
    $arFilter = ['ACTIVE' => 'Y', 'IBLOCK_ID' => $iblockId, 'ID' => $arrSpeakers];
    $arSelect = ['ID', 'NAME', 'PROPERTY_POST', 'PROPERTY_QUOTE', 'PROPERTY_SPEAKERS', 'PREVIEW_PICTURE', 'PROPERTY_REZUME'];

    $res = CIBlockElement::getList($arSort, $arFilter, false, [], $arSelect);
    while ($row = $res->fetch()) {
        $speakers[] = [
            'ID' => $row['ID'],
            'NAME' => $row['NAME'],
            'POST' => $row['PROPERTY_POST_VALUE'],
            'QUOTE' => $row['PROPERTY_QUOTE_VALUE'],
            'IMAGE' => CFile::GetPath($row['PREVIEW_PICTURE'])
        ];
    }

    $arResult['SPEAKERS'] = $speakers;
}

/**
 * Галерея
 */
$arResult['HAS_GALLERY'] = !empty($arResult['DISPLAY_PROPERTIES']['gallery']['FILE_VALUE']);