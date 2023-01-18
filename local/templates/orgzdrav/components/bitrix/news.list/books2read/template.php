<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<? foreach ($arResult['ITEMS'] as $i => $arItem): ?>
	<div class="book-link">
		<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="">
		<p class="book-link__title"><?= $arItem['NAME'] ?></p>
		<a class="u-link-holder" href="<?= $arItem['DISPLAY_PROPERTIES']['LINK']['VALUE'] ?>" target="_blank" rel="nofollow">перейти на сайт</a>
	</div>
<? endforeach; ?>