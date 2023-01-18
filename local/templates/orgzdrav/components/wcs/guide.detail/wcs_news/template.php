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
<article class="post">
    <h1><?= $arResult['header']['value'] ?></h1>
    <div class="post-meta">
<!--        <div class="post-meta__tag">Быть в курсе</div>-->
        <div class="post-meta__tag">Новости</div>
<!--        <div class="post-meta__tag">Covid-19</div>-->
        <div class="post-meta__txt">28 марта 2021</div>
        <div class="post-meta__cnt">3 890</div>
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
        <div>Автор: <strong>Мария Утурникова</strong></div>
		
		<? if (!empty($arResult['url']['value'])) : ?>
			<div>Источник статьи: <a href="<?= $arResult['url']['value'] ?>" target="_blank" rel="nofollow"><?= parse_url($arResult['url']['value'], PHP_URL_HOST) ?></a></div>
		<? endif; ?>
		
<!--        <div class="post-likes">-->
<!--            <button type="button" class="post-likes__btn post-likes__btn--thumbs-up-active">764</button>-->
<!--            <button type="button" class="post-likes__btn post-likes__btn--thumbs-down">34</button>-->
<!--        </div>-->
    </footer>
</article>