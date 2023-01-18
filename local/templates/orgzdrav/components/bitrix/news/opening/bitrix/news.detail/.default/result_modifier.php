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

$dateBegin = new \Bitrix\Main\Type\DateTime($arResult['ACTIVE_FROM']);
$arResult['ACTIVE_FROM'] = Format::getFormatDate($dateBegin->getTimestamp());

$iblockId = 19;

if (CModule::IncludeModule("iblock")) {
    $arSort = ['SORT' => 'ASC', 'ID' => 'ASC'];
    $arFilter = ['ACTIVE' => 'Y', 'IBLOCK_ID' => $iblockId];
    $arSelect = ['ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_LINK'];

    $res = CIBlockElement::getList($arSort, $arFilter, false, [], $arSelect);
    while ($row = $res->fetch()) {
        $speakers[] = [
            'ID' => $row['ID'],
            'NAME' => $row['NAME'],
            'LINK' => $row['PROPERTY_LINK_VALUE'],
            'IMAGE' => CFile::GetPath($row['PREVIEW_PICTURE'])
        ];
    }
}