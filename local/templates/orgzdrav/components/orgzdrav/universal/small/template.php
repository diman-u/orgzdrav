<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

foreach ($arResult['ITEMS'] as $arItem): ?>
	<article class="news-small" id="<?= $arItem['ID'] ?>">
		<?  if (!empty($arItem['IMG']['SRC'])) : ?>
		<div class="news-small__img">
			 <img src="<?= $arItem['IMG']['SRC']; ?>" alt="<?= htmlspecialchars($arItem['NAME']) ?>" />
		</div>
		<? endif; ?>
		<div class="news-small__content">
			<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="news-small__title u-link-holder"><?= $arItem['NAME'] ?></a>

			<div class="post-meta">
				<div class="post-meta__tag"><?= $arItem['ENTITY_CATEGORY'] ?></div>
				<div class="post-meta__txt"><?= $arItem['ACTIVE_FROM'] ?></div>
			</div>
		</div>
	</article>
<? endforeach; ?>