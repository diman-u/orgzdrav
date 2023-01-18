<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false)) {
	return;
}

if ($arResult['NavPageNomer'] < $arResult['NavPageCount']):
	$nextUrl = $APPLICATION->GetCurPageParam('PAGEN_' . $arResult['NavNum'] . '='.($arResult["NavPageNomer"]+1), ['PAGEN_' . $arResult['NavNum'], 'load-more']);
?>
<div class="page-load-status js-pagen-<?= $arResult['NavNum']; ?>">
	<div class="infinite-scroll-request"></div>
</div>
<div class="text-center mt-24 js-load-more js-pagen-<?= $arResult['NavNum']; ?>" data-pagen="<?= $arResult['NavNum']; ?>" data-total="<?= $arResult['NavPageCount']; ?>">
	<a href="<?= $nextUrl; ?>" class="btn">Показать еще</a>
</div>
<? endif;?>