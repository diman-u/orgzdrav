<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="grid-2col mt-28">
	<div class="grid-2col__column">
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"support",
			array(
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"ADD_SECTIONS_CHAIN" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_GROUPS" => "N"
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