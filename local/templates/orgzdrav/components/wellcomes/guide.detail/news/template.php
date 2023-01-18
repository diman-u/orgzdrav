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

$this->setFrameMode(true);
?>
<article class="post content" data-type="<?= $arResult['guide'] ?>" data-id="<?= $arResult['id'] ?>">
    <h1><?= $arResult['header'] ?></h1>
    <div class="post-meta">
        <div class="post-meta__tag"><?= $arResult['META_TAG']; ?></div>
        <div class="post-meta__txt"><?= $arResult['idx_key_date'] ?></div>
        <div class="post-meta__cnt"></div>
    </div>

	<? if (!empty($arResult['video'])) : ?>
        <figure class="image image--ratio image--16by9">
			<? if ('youtube' == $arResult['video']['provider']) : ?>
			<iframe src="<?= $arResult['video']['src'] ?>?rel=0&modestbranding=1&autohide=1&showinfo=0" frameborder="0" allowfullscreen></iframe>
			<? endif; ?>
		</figure>
    <? elseif (!empty($arResult['photos']['asis'])) : ?>
        <figure>
            <img src="<?= $arResult['photos']['asis'] ?>" alt="">
			<?php if (!empty($arResult['figcaption'])) : ?>
				<figcaption><?= $arResult['figcaption'] ?></figcaption>
			<? endif; ?>
        </figure>
    <? endif; ?>

	<? /*if (!empty($arResult['annotation'])) : ?>
		<div class="post__annotation">
			<?= $arResult['annotation'] ?>
		</div>
    <? endif;*/ ?>

    <div class="post__content">
        <?= $arResult['text'] ?>
    </div>
	
<? $this->SetViewTarget('news-footer'); ?>
	<? if (!empty($arResult['url'])) : ?>
		<div>Источник: <a href="<?= $arResult['url'] ?>" target="_blank" rel="nofollow"><?= parse_url($arResult['url'], PHP_URL_HOST) ?></a></div>
	<? endif; ?>
<? $this->EndViewTarget(); ?>