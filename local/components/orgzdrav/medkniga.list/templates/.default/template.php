<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);
?>
<div class="grid grid--md-2 grid--xl-4">
	<? foreach ($arResult['ITEMS'] as $i => $item) : ?>
		<div class="grid__column">
			<article class="event-item">
				<div class="event-item__img event-item__img--auto">
					<img src="<?= $item->images[0]->src; ?>" alt="<?= htmlspecialchars($item->name) ?>" />
				</div>
				<div class="event-item__content">
					<a class="event-item__title u-link-holder" href="<?= $item->permalink ?>" target="_blank" rel="nofollow">
                        <?= $item->name ?>
                    </a>
					<?= $item->description ?>

                    <div class="post-meta">
                        <div class="post-meta__tag is-big">Книги</div>
                        <div class="post-meta__txt"><?= FormatDate('d F Y', strtotime($item->created_at)) ?></div>
                    </div>
				</div>
			</article>
		</div>
	<? endforeach; ?>
</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.pagenavigation",
	"",
	array(
		"NAV_OBJECT" => $arResult['NAV'],
		"SEF_MODE" => "N",
	),
	false
);?>