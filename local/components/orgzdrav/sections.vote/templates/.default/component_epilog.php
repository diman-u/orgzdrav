<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult['ITEMS'])) : ?>

	<? if (!empty($arParams['TITLE'])) : ?>
		<h3><?= $arParams['TITLE'] ?></h3>
	<? endif; ?>

<div class="grid grid--xl-3">
    <? foreach ($arResult['ITEMS'] as $i => $arItem): ?>
    <div class="grid__column">
        <?$APPLICATION->IncludeComponent("orgzdrav:vot.current", "survey", array(
            "CHANNEL_ID" => $arItem['CHANNEL_ID'],
            "VOTE_ID" => $arItem['ID'],
            "VOTE_ALL_RESULTS" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_SHADOW" => "Y",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "AJAX_OPTION_ADDITIONAL" => "",
            "TITLE_BLOCK" => "Polls",
        ),
            false
        );?>
    </div>
    <? endforeach; ?>
</div>
<? endif; ?>