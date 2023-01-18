<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->SetPageProperty('HIDE_H1', 'Y');

$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "sect", 
		"AREA_FILE_SUFFIX" => "hero", 
		"AREA_FILE_RECURSIVE" => "N", 
		"EDIT_MODE" => "html", 
	)
);
?>
<div class="grid-2col">
	<div class="grid-2col__column">
		<?$APPLICATION->IncludeComponent(
			"wcs:guide.list",
			"wcs_news",
			array(
				'GUIDE' => $arParams['GUIDE'],
				'FIELDS' => $arParams['FIELDS'],
				'SEF_FOLDER' => $arParams['SEF_FOLDER'],
				'USE_COUNTER' => $arParams['USE_COUNTER'],
				'LIMIT' => $arParams['LIMIT']
			),
			false
		);?>
	</div>
	<div class="grid-2col__column">
		<?
        require_once $_SERVER['DOCUMENT_ROOT'] . '/include/sidebar-news.php';
//        $APPLICATION->IncludeComponent(
//			"wcs:guide.list",
//			"wcs_news.small",
//			array(
//				'GUIDE' => $arParams['GUIDE'],
//				'FIELDS' => ['header', 'photos'],
//				'SEF_FOLDER' => $arParams['SEF_FOLDER'],
//				'LIMIT' => 9
//			),
//			false
//		);
        ?>
	</div>
</div>