<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

foreach ($arResult['ITEMS'] as $item): ?>
	<article class="news-item" data-id="<?= $item["id"] ?>">
		<div class="news-item__content">
			<div class="news-item__img">
				<img src="<?= $item['photos']['asis'] ?>" alt="">
			</div>
			<div class="news-item__main">
                <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="news-item__title u-link-holder"><?= $item['header'] ?></a>
                <div class="post-meta">
                    <div class="post-meta__tag"><?= isset($item['SECTION']['NAME']) ? $item['SECTION']['NAME'] : 'Новости'; ?></div>
                </div>
            </div>

            <div class="post-meta">
                <div class="post-meta__txt"><?= $item['idx_key_date'] ?></div>
            </div>
        </div>
	</article>
<? endforeach; ?>