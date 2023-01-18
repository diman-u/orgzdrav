<?php

use Orgzdrav\Helper\Format;

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

/**
 * Формат даты
 */

$dateBegin = new \Bitrix\Main\Type\DateTime($arResult['ACTIVE_FROM']);
$arResult['DATE_BEGIN'] = Format::getFormatDate($dateBegin->getTimestamp());

$dateEnd = new \Bitrix\Main\Type\DateTime($arResult['PROPERTIES']['DATE_END']['VALUE']);
$arResult['DATE_END'] = Format::getFormatDate($dateEnd->getTimestamp());

/**
 * Спикеры
 */
$arrSpeakers = $arResult['PROPERTIES']['SPEAKERS']['VALUE'];

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