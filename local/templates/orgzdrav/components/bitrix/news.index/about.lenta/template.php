<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<? if (!empty($arResult['TOP_ITEMS'])) : ?>
	<div class="grid grid--lg-2">
		<? foreach ($arResult['TOP_ITEMS'] as $arItem) : ?>
			<div class="grid__column">
				<article class="event-item js-cnt" data-type="iblock" data-id="<?= $arItem["ID"] ?>">
					<div class="event-item__img">
						<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= htmlspecialchars($arItem["NAME"]) ?>" />
					</div>
					<div class="event-item__content">
						<a class="event-item__title u-link-holder" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
						<p><?= $arItem["PREVIEW_TEXT"] ?></p>
						
						<div class="post-meta">
							<div class="post-meta__tag is-big"><?= $arItem['META_TAG'] ?></div>
							<div class="post-meta__txt"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></div>
							<div class="post-meta__cnt"></div>
						</div>
					</div>
				</article>
			</div>
		<? endforeach; ?>
	</div>
<? endif; ?>

<div class="display-list with-img <? !empty($arResult['TOP_ITEMS']) and print ' mt-32' ?>">
	<? foreach ($arResult['ITEMS'] as $arItem) : ?>
		<article class="news-item" data-id="<?= $arItem['ID'] ?>">
			<div class="news-item__content">
				<? if (!empty($arItem['PREVIEW_PICTURE']['SRC'])) : ?>
				<div class="news-item__img">
					<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= htmlspecialchars($arItem['NAME']) ?>" />
				</div>
				<? endif; ?>
				<div class="news-item__main">
					<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="news-item__title u-link-holder" target="<?= $arItem['TARGET'] ?>"><?= $arItem['NAME'] ?></a>
					<div class="post-meta">
						<div class="post-meta__tag"><?= $arItem['META_TAG'] ?></div>
					</div>
				</div>
				<div class="post-meta">
					<div class="post-meta__txt"><?= $arItem['DISPLAY_ACTIVE_FROM'] ?></div>
				</div>
			</div>
		</article>
	<? endforeach; ?>
</div>