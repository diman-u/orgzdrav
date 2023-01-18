<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

?>
<? foreach ($arResult['ITEMS'] as $i => $arItem) : ?>
	<article class="news-item js-cnt" data-type="iblock" data-id="<?= $arItem["ID"] ?>">
		<? if (!empty($arItem['PREVIEW_PICTURE']['SRC'])) : ?>
		<div class="news-item__img">
			<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= htmlspecialchars($arItem["NAME"]) ?>" />
		</div>
		<? endif; ?>
		<div class="news-item__content">
			<a class="news-item__title u-link-holder" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
			<p><?= $arItem["PREVIEW_TEXT"] ?></p>

			<div class="post-meta">
				<div class="post-meta__txt"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></div>
				<div class="post-meta__cnt"></div>
			</div>
		</div>
	</article>
<? endforeach; ?>