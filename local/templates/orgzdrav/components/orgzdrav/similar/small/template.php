<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>

<hr>
<h2>Смотрите также</h2>

<? foreach ($arResult['ITEMS'] as $item): ?>
	<article class="news-item js-cnt" data-type="iblock" data-id="<?= $item["ID"] ?>">
		<div class="news-item__img">
			<img src="<?= $item['IMG']['SRC']; ?>" alt="<?= htmlspecialchars($item['NAME']) ?>">
		</div>
		<div class="news-item__content">
			<a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="news-item__title u-link-holder"><?= htmlspecialchars($item['NAME']) ?></a>
			<p><?= strip_tags($item['PREVIEW_TEXT']) ?></p>

			<div class="post-meta">
				<div class="post-meta__tag"><?= $item['ENTITY_CATEGORY']; ?></div>
				<div class="post-meta__txt"><?= $item['ACTIVE_FROM'] ?></div>
				<div class="post-meta__cnt"></div>
			</div>
		</div>
	</article>
<? endforeach; ?>

