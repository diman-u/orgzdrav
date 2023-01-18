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
        <div class="post-meta__tag">Статьи</div>
        <div class="post-meta__txt">28 марта 2021</div>
        <div class="post-meta__cnt">3 890</div>
<!--        <a class="post-meta__bookmark" href=""></a>-->
    </div>
	
	<? if (!empty($arResult['photos']['asis'])) : ?>
		<figure>
			<img src="<?= $arResult['photos']['asis'] ?>" alt="<?= htmlspecialchars($arResult['header']['value']) ?>" />
		</figure>
	<? endif; ?>
    
	<?= $arResult['text']['value'] ?>

    <footer>
		<? if (!empty($arResult['autor']['value'])) : ?>
			<div>Автор: <strong><?= $arResult['autor']['value'] ?></strong></div>
		<? endif; ?>
		
<!--        <div class="post-likes">-->
<!--            <button type="button" class="post-likes__btn post-likes__btn--thumbs-up-active">764</button>-->
<!--            <button type="button" class="post-likes__btn post-likes__btn--thumbs-down">34</button>-->
<!--        </div>-->
    </footer>
</article>