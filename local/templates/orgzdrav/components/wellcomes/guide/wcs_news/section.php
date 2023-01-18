<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->SetPageProperty('HIDE_H1', 'Y');
$APPLICATION->AddHeadString('<link rel="canonical" href="https://www.orgzdrav.com' . str_replace('index.php', '', $APPLICATION->GetCurPage(true)) . '" />');

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

$gridExtraClass = '';
if (isset($_COOKIE['display-style']) && 'list' == $_COOKIE['display-style']) {
	$gridExtraClass = ' display-list grid-2col--one-column';
}
?>
<div class="grid-2col js-main-list<?= $gridExtraClass ?>">
	<div class="grid-2col__column">
		<?$APPLICATION->IncludeComponent(
			"wellcomes:guide.list", 
			"article", 
			$arParams, 
			false
		);?>
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
    sidebar.start(['#news-small-1'], 17, currentNewsIds);
});
</script>