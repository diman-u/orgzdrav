<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($arResult['SECTION_DESCRIPTION'])) {
	$APPLICATION->Setpageproperty('HERO_CONTENT', $arResult['SECTION_DESCRIPTION']);
}