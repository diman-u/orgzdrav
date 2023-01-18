<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
use DOMWrap\Document;

$this->setFrameMode(true);
?>
<article class="post content" data-type="wcs_news" data-id="<?= $arResult["id"] ?>">
    <h1><?= $arResult['header'] ?></h1>
    <div class="post-meta">
        <div class="post-meta__tag"><?= isset($arResult['SECTION']['NAME']) ? $arResult['SECTION']['NAME'] : 'Новости'; ?></div>
        <div class="post-meta__txt"><?= $arResult['idx_key_date'] ?></div>
        <div class="post-meta__cnt"></div>
    </div>
    <?= $arResult['preamble'] ?>

    <? if (!empty($arResult['photos']['asis'])) : ?>
        <figure>
            <img src="<?= $arResult['photos']['asis'] ?>" alt="">
			
			<? if (!empty($arResult['photo'])) : ?>
				<figcaption>Фото: <?= $arResult['photo'] ?></figcaption>
			<? endif; ?>
			<?php if (!empty($arResult['copyright'])) : ?>
				<figcaption><?= $arResult['copyright'] ?></figcaption>
			<? endif; ?>
        </figure>
    <? endif; ?>

    <div class="post__content">
        <?= $arResult['text'] ?>
    </div>
	
<? $this->SetViewTarget('news-footer'); ?>
	<? if (!empty($arResult['url'])) : ?>
		<div>Источник статьи: <a href="<?= $arResult['url'] ?>" target="_blank" rel="nofollow"><?= parse_url($arResult['url'], PHP_URL_HOST) ?></a></div>
	<? endif; ?>
<? $this->EndViewTarget(); ?>