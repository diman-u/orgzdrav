<? foreach ($arResult['ITEMS'] as $i => $item): ?>
	<article class="news-small">
		<div class="news-small__img">
			<img src="<?= $item['photos']['asis'] ?>" alt="">
		</div>
		<div class="news-small__content">
			<a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="news-small__title u-link-holder"><?= $item['header'] ?></a>

			<div class="post-meta">
				<div class="post-meta__tag"><?= isset($item['SECTION']['NAME']) ? $item['SECTION']['NAME'] : 'Новости'; ?></div>
				<div class="post-meta__txt">
                    <?= $item['idx_key_date'] ?>
                </div>
                <a class="post-meta__bookmark" href="#"
                   data-id="<?= $item['id'] ?>"
                   data-type="wcs_news"
                   data-active="0"
                ></a>

            </div>
		</div>
	</article>
<? endforeach; ?>