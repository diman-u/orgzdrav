<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

foreach ($arResult['ITEMS'] as $item): ?>
	<article class="news-item js-cnt" data-type="<?= $item["guide"] ?>" data-id="<?= $item["id"] ?>">
		<div class="news-item__img">
			<img src="<?= $item['photos']['asis'] ?>" alt="">
		</div>
		<div class="news-item__content">
			<a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="news-item__title u-link-holder"><?= $item['header'] ?></a>
			<p><?= strip_tags($item['annotation']) ?></p>

			<div class="post-meta">
				<div class="post-meta__tag"><?= isset($item['SECTION']['NAME']) ? $item['SECTION']['NAME'] : $arParams['META_TAG']; ?></div>
				<div class="post-meta__txt"><?= $item['idx_key_date'] ?></div>
				<div class="post-meta__cnt"></div>
			</div>
		</div>
	</article>
<? endforeach; ?>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.pagenavigation",
	"",
	array(
		"NAV_OBJECT" => $arResult['NAV'],
		"SEF_MODE" => "N",
	),
	false
);?>