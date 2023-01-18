<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);
?>
<article class="news-item">
	<div class="news-item__img news-item__img--small">
		<img src="<?= $arResult['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arResult['NAME'] ?>" />
	</div>
	<div class="news-item__content">
		<?= $arResult['DISPLAY_PROPERTIES']['TEASER']['DISPLAY_VALUE'] ?>
		
		<? if (!empty($arParams['BIO_LINK'])) : ?>
		<p class="text-right">
			<a class="btn btn--light" href="<?= $arParams['BIO_LINK'] ?>">Читать биографию</a>
		</p>
		<? endif ?>
	</div>
</article>