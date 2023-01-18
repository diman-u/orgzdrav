<? foreach ($arResult['ITEMS'] as $item): ?>
	<article class="news-item">
		<div class="news-item__img">
			<img src="<?= $item['photos']['asis'] ?>" alt="">
		</div>
		<div class="news-item__content">
			<a href="<?= $item['detail_url'] ?>" class="news-item__title u-link-holder"><?= $item['header'] ?></a>
            <p><?= strip_tags($item['annotation']) ?></p>
              
            <div class="post-meta">
              <div class="post-meta__tag">Новости</div>
              <div class="post-meta__txt">2 ч назад</div>
              <div class="post-meta__cnt"><?= $item['view_counter'] ?></div>
<!--              <a class="post-meta__bookmark" href=""></a> -->
            </div>
		</div>
	</article>
<? endforeach; ?>