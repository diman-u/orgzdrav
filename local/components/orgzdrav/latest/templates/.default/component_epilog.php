<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

echo '<div class="display-latest">';

$APPLICATION->IncludeComponent(
	'orgzdrav:universal',
    $arParams['UNIVERSAL_TEMPLATE'],
    [
        "LIST_ENTITY" => $arResult['ITEMS'],
		"CACHE_TYPE" => $arParams['CACHE_TYPE'],
		"CACHE_TIME" => $arParams['CACHE_TIME'],
    ]
);

echo '</div>';