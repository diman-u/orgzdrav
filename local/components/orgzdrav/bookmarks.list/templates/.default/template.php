<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->IncludeComponent(
    'orgzdrav:universal',
    '',
    [
        'TEMPLATE_TYPE' => '',
        'LIST_ENTITY' => $arResult['ITEMS']
    ]
);
?>