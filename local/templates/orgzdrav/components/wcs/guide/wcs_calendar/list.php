<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?
$path = ($_GET['deb'] == 'Y') ? 'test_wcs_calendar' : 'wcs_calendar';
$APPLICATION->IncludeComponent(
	"wcs:guide.list",
    $path,
	array(
		'GUIDE' => $arParams['GUIDE'],
		'FIELDS' => $arParams['FIELDS'],
		'SEF_FOLDER' => $arParams['SEF_FOLDER'],
		'USE_COUNTER' => $arParams['USE_COUNTER'],
		'SORT' => $arParams['SORT'],
		'LIMIT' => $arParams['LIMIT']
	),
	false
);?>