<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult['DESCRIPTION'])) {
	$APPLICATION->SetPageProperty('HERO_CONTENT', $arResult['DESCRIPTION']);
}