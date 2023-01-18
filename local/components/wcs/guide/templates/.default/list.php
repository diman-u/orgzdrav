<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->IncludeComponent(
	"wcs:guide.list",
	"",
    array(
        'GUIDE' => $arParams['GUIDE'],
		'FIELDS' => $arParams['FIELDS'],
		'SEF_FOLDER' => $arParams['SEF_FOLDER']
    ),
	false
);