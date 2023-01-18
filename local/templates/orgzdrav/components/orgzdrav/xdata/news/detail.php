<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<div class="grid-2col">
    <div class="grid-2col__column">
        <?$APPLICATION->IncludeComponent(
            "orgzdrav:xdata.detail",
            "news",
            [
                "DRIVER" => $arParams['DRIVER'],
                "FROM" => $arParams['FROM'],
                "ENTITY_ID" => $arResult['VARIABLES']['ENTITY_ID'],
                'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],

                "DATE_FORMAT" => $arParams['DATE_FORMAT'],

                "SEO" => $arParams['SEO'],
                "SEF_MODE" => $arParams['SEF_MODE'],
                "SEF_FOLDER" => $arParams['SEF_FOLDER'],
                "SECTIONS" => $arParams['SECTIONS'],
                "CACHE_TYPE" => $arParams['CACHE_TYPE'],
                "CACHE_TIME" => $arParams['CACHE_TIME'],
            ],
            false
        );?>
        <?/*<h3>Смотрите также</h3>
        $APPLICATION->IncludeComponent(
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
        );*/?>
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
    sidebar.start(['#news-small-1'], 10);
});
</script>