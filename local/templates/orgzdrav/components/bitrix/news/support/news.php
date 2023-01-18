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

$res = CIBlockSection::GetList(
	[
		'SORT' => 'ASC'
	], [
		'IBLOCK_ID' => $arParams["IBLOCK_ID"],
		'ACTIVE' => 'Y',
		'SECTION_ID' => false
	], 
	true,
	['ID', 'IBLOCK_ID', 'CODE', 'NAME', 'SECTION_PAGE_URL']
);

$counter = 0;
$newsSidebarCounter = 1;

while($row = $res->GetNext()) :
	if (0 == $row['ELEMENT_CNT'])  {
		continue;
	}

	$odd = ($counter && 1 === $counter % 2);
?>
<? if (0 < $counter) : ?><section<? $odd and print ' class="theme-dark"' ?>><? endif; ?>
    <header>
        <h3><?= $row['NAME'] ?></h3>
        <a href="<?= $row['SECTION_PAGE_URL'] ?>" class="btn btn--light">Перейти в раздел</a>
    </header>
	<? if (!$odd) : ?>
	<div class="grid-2col mt-28">
		<div class="grid-2col__column">
	<? endif; ?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	($odd ? "articles-grid" : "articles"),
	Array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"PARENT_SECTION" => $row['ID'],
		"PARENT_SECTION_CODE" => $row['CODE'],
        "NEWS_COUNT" => 3,
        "SORT_BY1" => $arParams["SORT_BY1"],
		"SORT_ORDER1" => $arParams["SORT_ORDER1"],
		"SORT_BY2" => $arParams["SORT_BY2"],
		"SORT_ORDER2" => $arParams["SORT_ORDER2"],
        "FILTER_NAME" => "",
        "FIELD_CODE" => [],
        "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
        "CHECK_DATES" => "N",
        "DETAIL_URL" => $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['detail'],
        "ACTIVE_DATE_FORMAT" => "d F",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_LAST_MODIFIED" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "SET_STATUS_404" => "Y",
        "SHOW_404" => "Y"
    )
);?>
	<? if (!$odd) : ?>
		</div>
		<div class="grid-2col__column">
			<div id="news-small-<?= $newsSidebarCounter ++ ?>"></div>
        </div>
	</div>
	<? endif; ?>
</section> 
<?
	
	$counter ++;
endwhile;



\Bitrix\Main\UI\Extension::load("orgzdrav.news-small");
?>
<div id="news-sidebar"></div>
<script type="text/javascript">
    const sidebar = new BX.Orgzdrav.SidebarNewsSmall('#news-sidebar');
    sidebar.start([<? 
		print implode(',', array_map(
			function($item) { return sprintf('"#news-small-%d"', $item); },
			range(1, $newsSidebarCounter - 1)
		));  
	?>], 5);
</script>