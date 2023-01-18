<article class="post content">
    <h1><?= $arResult['title'] ?></h1>
    <div class="post-meta">
        <div class="post-meta__tag">Рейтинги</div>
        <div class="post-meta__txt"><?= FormatDate('d F Y', strtotime($arResult['created'])) ?></div>
    </div>
	
	<div class="post__content">
		<?= $arResult['text'] ?>
	</div>
</article>