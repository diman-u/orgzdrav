<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Orgzdrav\Helper\Format;

$this->setFrameMode(true);
?>
<? foreach ($arResult['ITEMS'] as $i => $arItem) {

    $dateTime = new \Bitrix\Main\Type\DateTime($arItem["ACTIVE_FROM"]);
?>
	<article class="news-item js-cnt" data-type="iblock" data-id="<?= $arItem["ID"] ?>">
		<? if ('Y' === $arItem['DISPLAY_PROPERTIES']['is_sponsor']['VALUE_XML_ID']) : ?>
			<div class="post-badge"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/logo/janssen-white.svg" alt=""></div>
		<? endif; ?>
		<div class="news-item__img">
			<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= htmlspecialchars($arItem["NAME"]) ?>" />
		</div>
		<div class="news-item__content">
			<a class="news-item__title u-link-holder" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
			<p><?= $arItem["PREVIEW_TEXT"] ?></p>

			<div class="post-meta">
				<div class="post-meta__tag"><?= $arParams['META_TAG'] ?></div>
				<div class="post-meta__txt"><?= Format::getFormatDate($dateTime->getTimestamp()) ?></div>
				<div class="post-meta__cnt"></div>
<!--				<a class="post-meta__bookmark" href=""></a>-->
			</div>
		</div>
	</article>
<? } ?>