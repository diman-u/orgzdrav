<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<div class="grid-2col">
	<div class="grid-2col__column">
		<?$APPLICATION->IncludeComponent(
			"wcs:guide.detail",
			"wcs_news",
			array(
				'GUIDE' => $arParams['GUIDE'],
				'ENTITY_ID' => $arParams['ENTITY_ID'],
				'ANCHOR' => $arParams['ANCHOR'],
				'USE_COUNTER' => $arParams['USE_COUNTER']
			),
			false
		);?>
		<h3>Смотрите также</h3>
		<?$APPLICATION->IncludeComponent(
			"wcs:guide.list",
			"wcs_news",
			array(
				'GUIDE' => $arParams['GUIDE'],
				'FIELDS' => $arParams['LIST_FIELDS'],
				'SEF_FOLDER' => $arParams['SEF_FOLDER'],
				'USE_COUNTER' => $arParams['USE_COUNTER'],
				'DISABLED' => $arParams['ENTITY_ID'],
				'LIMIT' => 3
			),
			false
		);?>
	</div>
	<div class="grid-2col__column">
		<?$APPLICATION->IncludeComponent(
			"wcs:guide.list",
			"wcs_news.small",
			array(
				'GUIDE' => $arParams['GUIDE'],
				'FIELDS' => $arParams['LIST_FIELDS'],
				'SEF_FOLDER' => $arParams['SEF_FOLDER'],
				'DISABLED' => $arParams['ENTITY_ID'],
				'LIMIT' => 9
			),
			false
		);?>
	</div>
</div>