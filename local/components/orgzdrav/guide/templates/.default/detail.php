<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->IncludeComponent(
	"orgzdrav:guide.detail",
	"hmn.pth",
    array(
        'GUIDE' => $arParams['GUIDE'],
		'ENTITY_ID' => $arParams['ENTITY_ID'],
		'ANCHOR' => $arParams['ANCHOR']
    ),
	false
);