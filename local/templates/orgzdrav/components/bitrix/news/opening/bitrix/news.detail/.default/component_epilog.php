<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->SetPageProperty('HIDE_H1', 'Y');

\Orgzdrav\Support\Counter::display('iblock', $arResult['ID']);


$APPLICATION->IncludeComponent(
    'orgzdrav:similar',
    'small',
    [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ELEMENT_ID' => $arResult['ID'],
		'SORT_BY' => 'RAND',
		'CACHE_TIME' => '3600',
		'CACHE_TYPE' => 'Y',
    ]
);