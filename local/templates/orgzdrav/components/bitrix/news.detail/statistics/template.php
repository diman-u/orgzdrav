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
        <div class="post-meta__tag">Статистика</div>
        <div class="post-meta__txt"><?= $arResult['DISPLAY_ACTIVE_FROM'] ?></div>
        <div class="post-meta__cnt"></div>
<!--        <a class="post-meta__bookmark" href=""></a>-->
    </div>
	
	<? if (!empty($arResult['DETAIL_PICTURE']['SRC'])) : ?>
		<figure>
			<img src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?= htmlspecialchars($arResult['NAME']) ?>" />
		</figure>
	<? endif; ?>
    
	<div class="post__content">
		<?= $arResult['DETAIL_TEXT'] ?>