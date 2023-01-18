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
<?
$isAjaxLoadMore = isset($_REQUEST['load_more']);
if ($isAjaxLoadMore)
	$APPLICATION->RestartBuffer();

$APPLICATION->IncludeComponent(
	"orgzdrav:xdata.list",
	"news",
	[
		"DRIVER" => $arParams['DRIVER'],
		"FROM" => $arParams['FROM'],
		"SELECT" => $arParams['SELECT'],
		"FILTER" => $arParams['FILTER'],
		"SORT" => $arParams['SORT'],
		"LIMIT" => $arParams['LIMIT'],

		"DATE_FORMAT" => $arParams['DATE_FORMAT'],
		"PAGER_TEMPLATE" => $arParams['PAGER_TEMPLATE'],

		"SEO" => $arParams['SEO'],
		"SEF_MODE" => $arParams['SEF_MODE'],
		"SEF_FOLDER" => $arParams['SEF_FOLDER'],
		"SEF_URL_TEMPLATES" => $arParams['SEF_URL_TEMPLATES'],
		"SECTIONS" => $arParams['SECTIONS'],

		"VARIABLES" => $arResult["VARIABLES"],
		"CACHE_TYPE" => $arParams['CACHE_TYPE'],
		"CACHE_TIME" => $arParams['CACHE_TIME'],
	],
	false
);
		
if ($isAjaxLoadMore) {
    $APPLICATION->FinalActions();
    exit;
}		
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
	let currentNewsIds = [];
	$('.news-item[data-id]').each((index, element) => {
		currentNewsIds.push(parseInt(element.getAttribute('data-id')));
	});
	
    const sidebar = new BX.Orgzdrav.SidebarNewsSmall('#news-sidebar');
    sidebar.start(['#news-small-1'], 20, currentNewsIds);
});
</script>