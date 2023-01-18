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
<article class="post content" data-type="iblock" data-id="<?= $arResult['ID'] ?>">
    <h1><?= $arResult['NAME'] ?></h1>
    <div class="post-meta">
        <div class="post-meta__tag">Статьи</div>
        <div class="post-meta__txt"><?= $arResult['DISPLAY_ACTIVE_FROM'] ?></div>
        <div class="post-meta__cnt"></div>
<!--        <a class="post-meta__bookmark" href=""></a>-->
    </div>
	
	<? if ('Y' === $arResult['DISPLAY_PROPERTIES']['is_sponsor']['VALUE_XML_ID']) : ?>
		<div class="flex-line"><span>При поддержке</span> <img src="/sponsor/janssen-logo.png" alt="Janssen"></div>
	<? endif; ?>
	
	<? if (!empty($arResult['DETAIL_PICTURE']['SRC'])) : ?>
		<figure>
			<img src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?= htmlspecialchars($arResult['NAME']) ?>" />
		</figure>
	<? endif; ?>
    
	<div class="post__content">
		<?= $arResult['DETAIL_TEXT'] ?>
	</div>
	
<? $this->SetViewTarget('article-footer'); ?>
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['author']['VALUE'])) : ?>
		<div>Автор: <strong><?= $arResult['DISPLAY_PROPERTIES']['author']['VALUE'] ?></strong></div>
	<? endif; ?>
<? $this->EndViewTarget(); ?>