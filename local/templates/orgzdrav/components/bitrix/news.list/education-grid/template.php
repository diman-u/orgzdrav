<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<div class="grid grid--xl-3">
	<? foreach ($arResult['ITEMS'] as $i => $arItem): ?>
		<div class="grid__column">
			<article class="event-item js-cnt" data-type="iblock" data-id="<?= $arItem["ID"] ?>">
				<div class="event-item__img">
					<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= htmlspecialchars($arItem["NAME"]) ?>" />
					<? if (!empty($arItem['DISPLAY_PROPERTIES']['presence']['VALUE'])) : ?>
						<div class="event-item__img-badge theme-<?
							print 'online' == $arItem['DISPLAY_PROPERTIES']['presence']['VALUE_XML_ID']
								? 'blue'
								: 'dark';
						?>"><?= $arItem['DISPLAY_PROPERTIES']['presence']['VALUE'] ?></div>
					<? endif; ?>
				</div>
				<div class="event-item__content">
					<a class="event-item__title u-link-holder" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
					<p><?= $arItem["PREVIEW_TEXT"] ?></p>
					<? if (!empty($arItem['DISPLAY_PROPERTIES']['training_type']['VALUE'])) : ?>
						<div class="event-item__value">Проводим: <span><?= $arItem['DISPLAY_PROPERTIES']['training_type']['VALUE'] ?></span></div>
					<? endif; ?>

					<div class="post-meta">
						<div class="post-meta__tag is-big">Обучение</div>
						<? if (!empty($arItem["CURRENT_DATE"])) : ?>
							<div class="post-meta__txt"><?= $arItem["CURRENT_DATE"] ?></div>
						<? endif ; ?>
						<div class="post-meta__cnt"></div>
						<?/*<a class="post-meta__bookmark" href=""></a>*/?>
					</div>
				</div>
				<div class="event-item__footer">
					<? if (!empty($arItem["CURRENT_PRICE"])) : ?>
					<span class="btn btn--small btn--bright"><?= $arItem["CURRENT_PRICE"] ?></span>
					<? endif ; ?>
				</div>
			</article>
		</div>
	<? endforeach; ?>
</div>