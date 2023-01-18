<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<? foreach ($arResult['ITEMS'] as $i => $arItem): ?>
	<article class="news-item">
		<? /*if ('Y' === $arItem['DISPLAY_PROPERTIES']['is_sponsor']['VALUE_XML_ID']) : ?>
			<div class="post-badge"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/logo/janssen-white.svg" alt=""></div>
		<? endif;*/ ?>

		<div class="news-item__img">
			<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= htmlspecialchars($arItem["NAME"]) ?>" />
		</div>
		<div class="news-item__content">
			<a class="news-item__title u-link-holder" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
			<p><?= $arItem["PREVIEW_TEXT"] ?></p>

			<div class="post-meta">
				<div class="post-meta__tag">Статья</div>
				<div class="post-meta__txt"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></div>
				<div class="post-meta__cnt">1 890</div>
				<a class="post-meta__bookmark 111" href=""></a>
			</div>
		</div>
	</article>
<? endforeach; ?>