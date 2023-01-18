<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="grid-2col">
	<div class="grid-2col__column">
	<?
$arParams["ENTITY_ID"] = $arResult['VARIABLES']['ENTITY_ID'];
$arParams["SECTION_CODE"] = $arResult['VARIABLES']['SECTION_CODE'];

$APPLICATION->IncludeComponent(
	"wellcomes:guide.detail", 
	"news", 
	$arParams, 
	false
);
	?>	
	</div>
	<div class="grid-2col__column">
		<div id="news-sidebar"></div>
		<div id="news-small-1"></div>
    </div>
</div>

<? \Bitrix\Main\UI\Extension::load("orgzdrav.news-small"); ?>
<script type="text/javascript">
$(function() {
    const sidebar = new BX.Orgzdrav.SidebarNewsSmall('#news-sidebar');
    sidebar.start(['#news-small-1'], 10, [<?= $arResult['VARIABLES']['ENTITY_ID'] ?>]);
});
</script>