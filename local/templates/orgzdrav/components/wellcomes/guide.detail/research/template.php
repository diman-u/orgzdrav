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
	
	<?php if (!empty($arResult['copyright'])) : ?>
		<figure><figcaption><?= $arResult['copyright'] ?></figcaption></figure>
	<? endif; ?>

	<? if (!empty($arResult['annotation'])) : ?>
		<div class="post__annotation">
			<?= $arResult['annotation'] ?>
		</div>
    <? endif; ?>

    <div class="post__content">
        <?= $arResult['text'] ?>
    </div>