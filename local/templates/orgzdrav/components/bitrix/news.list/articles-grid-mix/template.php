<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<div class="grid grid--xl-3">
	<? foreach ($arResult['ITEMS'] as $i => $arItem): ?>
		<div class="grid__column">
			<article class="article-item">
				<div class="article-item__img">
					<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= htmlspecialchars($arItem["NAME"]) ?>" />
				</div>
				<div class="article-item__content">
					<div class="post-meta">
						<div class="post-meta__tag is-big">Статья</div>
						<div class="post-meta__txt"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></div>
						<div class="post-meta__cnt">2 908</div>
						<?/*<a class="post-meta__bookmark" href=""></a>*/?>
					</div>

					<a class="article-item__title u-link-holder" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
					
					<p><?= $arItem["PREVIEW_TEXT"] ?></p>
				</div>
			</article>
		</div>
	<? endforeach; ?>
</div>