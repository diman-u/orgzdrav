<? foreach ($arResult['ITEMS'] as $i => $item): ?>
	<? /*if ($i && (0 === $i % 4) && ($i + 1) < count($arResult['ITEMS'])) : ?>
        <div class="demo-banner is-medium"></div>
	<? endif;*/ ?>
	<article class="news-small">
		<div class="news-small__img">
			<img src="<?= $item['photos']['asis'] ?>" alt="">
		</div>
		<div class="news-small__content">
			<a href="<?= $item['detail_url'] ?>" class="news-small__title u-link-holder"><?= $item['header'] ?></a>
              
			<div class="post-meta">
				<div class="post-meta__tag">Новости</div>
				<div class="post-meta__txt">1 ч назад</div>
<!--				<a class="post-meta__bookmark" href=""></a> -->
            </div>
		</div>
	</article>
<? endforeach; ?>