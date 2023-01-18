<article class="post content post--education" data-type="iblock" data-id="<?= $arResult['ID'] ?>">
	<h1><?= $arResult['NAME'] ?></h1>
    <div class="post-meta">
        <div class="post-meta__tag">Видео</div>
        <div class="post-meta__txt"><?= $arResult['ACTIVE_FROM'] ?></div>
        <div class="post-meta__cnt"></div>
<!--        <a class="post-meta__bookmark" href=""></a>-->
    </div>

	<div class="mt-4 mb-8">
		<iframe
			width="700"
			height="400"
			src="https://www.youtube.com/embed/<?= $arResult['PROPERTIES']['LINK']['VALUE'] ?>"
			title="YouTube video player" frameborder="0"
			allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
			allowfullscreen
		>
		</iframe>
	</div>

    <? if ('text' == $arResult['DETAIL_TEXT_TYPE']): ?>
		<p><?= $arResult['~DETAIL_TEXT'] ?></p>
	<? else : ?>
		<?= $arResult['DETAIL_TEXT'] ?>
	<? endif; ?>
</article>