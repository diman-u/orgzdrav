<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<div class="grid-2col">
	<div class="grid-2col__column">
		<?$APPLICATION->IncludeComponent(
			"wcs:guide.detail",
			"wcs_calendar",
			array(
				'GUIDE' => $arParams['GUIDE'],
				'ENTITY_ID' => $arParams['ENTITY_ID'],
				'ANCHOR' => $arParams['ANCHOR'],
				'USE_COUNTER' => $arParams['USE_COUNTER']
			),
			false
		);?>
	</div>
	<div class="grid-2col__column">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"COMPONENT_TEMPLATE" => ".default",
				"EDIT_TEMPLATE" => "",
				"PATH" => "/include/sidebar-news.php"
			)
		);?>
	</div>
</div>