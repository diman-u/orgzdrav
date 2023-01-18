<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

?>
<article class="post content" data-type="iblock" data-id="<?= $arResult['ID'] ?>">
    <div class="post-meta">
        <div class="post-meta__tag">Выступления</div>
        <div class="post-meta__txt"><?= $arResult['DISPLAY_ACTIVE_FROM'] ?></div>
        <div class="post-meta__cnt"></div>
    </div>
	
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['YOUTUBE']['VALUE'])) : ?>
        <figure class="image image--ratio image--16by9">
			<iframe src="<?= $arResult['DISPLAY_PROPERTIES']['YOUTUBE']['VALUE'] ?>?rel=0&modestbranding=1&autohide=1&showinfo=0" frameborder="0" allowfullscreen></iframe>
		</figure>
    <? endif; ?>
	
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['PDF']['FILE_VALUE']['SRC'])) : ?>
	<div class="mb-20">
		<a href="<?= $arResult['DISPLAY_PROPERTIES']['PDF']['FILE_VALUE']['SRC'] ?>" class="btn" target="_blank">
			Скачать презентацию в pdf
		</a>
	</div>
	<? endif; ?>
	
	<?= $arResult['~DETAIL_TEXT'] ?>
	
	
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['SOURCE']['VALUE'])) : ?>
	<footer>
		<div>Источник: <a href="<?= $arResult['DISPLAY_PROPERTIES']['SOURCE']['VALUE'] ?>" target="_blank" rel="nofollow"><?= parse_url($arResult['DISPLAY_PROPERTIES']['SOURCE']['VALUE'], PHP_URL_HOST) ?></a></div>
	</footer>
	<? endif; ?>
</article>