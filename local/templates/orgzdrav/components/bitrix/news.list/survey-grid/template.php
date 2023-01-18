<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<div class="grid grid--xl-3">
	<? foreach ($arResult['ITEMS'] as $i => $arItem): ?>
		<div class="grid__column">
			<div class="tools-item tools-item--small tools-item--theme-bg tools-item--theme-blue">
                <a class="tools-item__title u-link-holder" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
                <p><?= $arItem["PREVIEW_TEXT"] ?></p>
                <div class="btn btn--small btn--white">Пройти опрос</div>
            </div>
		</div>
	<? endforeach; ?>
</div>