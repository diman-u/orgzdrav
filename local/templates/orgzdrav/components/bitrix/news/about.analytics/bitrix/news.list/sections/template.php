<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<? foreach ($arResult['SECTIONS'] as $sectionId => $section) : 
	if (!$section['HAS_ITEMS']) {
		continue;
	}
?>
	<h3><?= $section['NAME'] ?></h3>
	
	<div class="display-list with-img">
		<? foreach ($arResult['ITEMS'] as $arItem) : 
			if ($arItem['IBLOCK_SECTION_ID'] != $sectionId) {
				continue;
			}
		?>
			<article class="news-item" data-id="<?= $arItem['ID'] ?>">
				<div class="news-item__content">
					<? if (!empty($arItem['PREVIEW_PICTURE']['SRC'])) : ?>
					<div class="news-item__img">
						<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= htmlspecialchars($arItem['NAME']) ?>" />
					</div>
					<? endif; ?>
					<div class="news-item__main">
						<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="news-item__title u-link-holder" target="<?= $arItem['TARGET'] ?>"><?= $arItem['NAME'] ?></a>
					</div>
					<div class="post-meta">
						<div class="post-meta__txt"><?= $arItem['DISPLAY_ACTIVE_FROM'] ?></div>
					</div>
				</div>
			</article>
		<? endforeach; ?>
	</div>
<? endforeach; ?>