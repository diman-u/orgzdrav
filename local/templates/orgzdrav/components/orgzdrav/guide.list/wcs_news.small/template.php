<? foreach ($arResult['ITEMS'] as $item): ?>
	<article class="news-small">
		<div class="news-small__img">
			<img src="/local/templates/orgzdrav/assets/img/demo/news-small-1.jpg" alt="">
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