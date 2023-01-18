<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult['MENU'] = [];

foreach ($arResult['body'] as $element) {
	if ('section' != $element['type']) {
		continue;
	}
	if (empty($element['id']) || empty($element['value']['head'])) {
		continue;
	}
	
	$arResult['MENU'][$element['id']] = $element['value']['head'];
}