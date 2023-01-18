<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

?>
<div class="grid-2col">
	<div class="grid-2col__column">
	<?
$arParams["ENTITY_ID"] = $arResult['VARIABLES']['ENTITY_ID'];
$arParams["SECTION_CODE"] = $arResult['VARIABLES']['SECTION_CODE'];

$APPLICATION->IncludeComponent(
	"wellcomes:guide.detail", 
	"research", 
	$arParams, 
	false
);
	?>	
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