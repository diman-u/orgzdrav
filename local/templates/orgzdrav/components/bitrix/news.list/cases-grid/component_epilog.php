<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (isset($arResult['DESCRIPTION'])) {
	$APPLICATION->Setpageproperty('HERO_CONTENT', $arResult['DESCRIPTION']);
}