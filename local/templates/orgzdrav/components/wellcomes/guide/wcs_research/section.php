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
?>
<div class="grid-2col">
	<div class="grid-2col__column">
		<?$APPLICATION->IncludeComponent(
			"wellcomes:guide.list", 
			"research", 
			$arParams, 
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