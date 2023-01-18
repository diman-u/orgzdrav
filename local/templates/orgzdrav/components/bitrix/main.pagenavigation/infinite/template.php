<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$component = $this->getComponent();
$this->setFrameMode(true);

if ($arResult["RECORD_COUNT"] == 0 || ($arResult["PAGE_COUNT"] == 1 && $arResult["SHOW_ALL"] == false)) {
	return;
}

if ($arResult['CURRENT_PAGE'] < $arResult['PAGE_COUNT']): 
	$nextUrl = htmlspecialcharsbx($component->replaceUrlTemplate($arResult["CURRENT_PAGE"]+1));
?>
<div class="page-load-status js-pagen-<?= $arResult['ID']; ?>">
	<div class="infinite-scroll-request"></div>
</div>
<div class="text-center mt-24 js-load-more js-pagen-<?= $arResult['ID']; ?>" data-pagen="<?= $arResult['ID']; ?>" data-total="<?= $arResult['PAGE_COUNT']; ?>">
	<a href="<?= $nextUrl; ?>" class="btn">Показать еще</a>
</div>
<? endif;?>