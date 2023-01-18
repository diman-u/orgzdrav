<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$themes = [
	'green',
	'blue',
	'red'
];
	
?>
<div class="grid grid--xl-3">
    <? foreach ($arResult['ITEMS'] as $i => $arItem): ?>
    <div class="grid__column">
        <?$APPLICATION->IncludeComponent(
			"orgzdrav:vot.current", 
			"", 
			array(
				"CHANNEL_ID" => $arItem['CHANNEL_ID'],
				"VOTE_ID" => $arItem['ID'],
				"CHANNEL_SID" => "SURVEYS",
				"VOTE_ALL_RESULTS" => "Y",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "3600",
				"AJAX_MODE" => "Y",
				"AJAX_OPTION_JUMP" => "Y",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "Y",
				"THEME" => "tools-item--theme-".$themes[$i%count($themes)]
			),
            false
        );?>
    </div>
    <? endforeach; ?>
</div>