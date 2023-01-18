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
<article class="post content js-cnt-inc" data-type="<?= $arParams['GUIDE'] ?>" data-id="<?= $arResult['id'] ?>">
    <h1><?= $arResult['header']['value'] ?></h1>
    <div class="post-meta">
        <div class="post-meta__tag">Мероприятия</div>
        <div class="post-meta__txt"><?= FormatDate('d F Y', strtotime($arResult['idx_key_date'])) ?></div>
        <div class="post-meta__cnt"></div>
<!--        <a class="post-meta__bookmark" href=""></a>-->
    </div>
	
	<? if (!empty($arResult['photos']['asis'])) : ?>
		<figure>
			<img src="<?= $arResult['photos']['asis'] ?>" alt="">
		</figure>
	<? endif; ?>
    
	<?= $arResult['preamble']['value'] ?>
	<?= $arResult['text']['value'] ?>

    <footer>
        <div>Проводим: <strong><?= $arResult['place']['value'] ?></strong></div>
		
		<? if (!empty($arResult['source']['value'])) : ?>
			<div>Источник: <a href="<?= $arResult['source']['value'] ?>" target="_blank" rel="nofollow"><?= parse_url($arResult['source']['value'], PHP_URL_HOST) ?></a></div>
		<? endif; ?>
    </footer>
</article>