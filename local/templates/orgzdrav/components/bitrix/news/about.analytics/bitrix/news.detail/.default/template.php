<article class="post content" data-type="iblock" data-id="<?= $arResult['ID'] ?>">
    <div class="post-meta">
        <div class="post-meta__tag">Аналитика</div>
        <div class="post-meta__txt"><?= $arResult['DISPLAY_ACTIVE_FROM'] ?></div>
        <div class="post-meta__cnt"></div>
    </div>
	
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['PDF']['FILE_VALUE']['SRC'])) : ?>
	<div class="mb-20">
		<a href="<?= $arResult['DISPLAY_PROPERTIES']['PDF']['FILE_VALUE']['SRC'] ?>" class="btn" target="_blank">
			Скачать документ в pdf
		</a>
	</div>
	<? endif; ?>
	
	<?= $arResult['DETAIL_TEXT'] ?>
	
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['PDF']['FILE_VALUE']['SRC'])) : ?>
	<div class="mt-20 mb-20">
		<a href="<?= $arResult['DISPLAY_PROPERTIES']['PDF']['FILE_VALUE']['SRC'] ?>" class="btn" target="_blank">
			Скачать документ в pdf
		</a>
	</div>
	<? endif; ?>
</article>