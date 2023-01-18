<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Orgzdrav\Helper\Format;

$this->setFrameMode(true);
?>
<div class="grid grid--xl-3">
	<? foreach ($arResult['ITEMS'] as $i => $arItem) {

        $dateTime = new \Bitrix\Main\Type\DateTime($arItem["ACTIVE_FROM"]);
    ?>
		<div class="grid__column">
			<article class="event-item" id="<?= $arItem["ID"] ?>">
				<div class="event-item__img">
					<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= htmlspecialchars($arItem["NAME"]) ?>" />
				</div>
				<div class="event-item__content">
					<a class="event-item__title u-link-holder" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                        <?= $arItem["NAME"] ?>
                    </a>
					<p><?= $arItem["PREVIEW_TEXT"] ?></p>

                    <div class="post-meta">
                        <div class="post-meta__tag is-big">Книги</div>
                        <div class="post-meta__txt"><?= $arItem['PROPERTIES']['YEAR']['VALUE'] . ' г.' ?></div>
                        <div class="post-meta__cnt"></div>
<!--                        <a class="post-meta__bookmark" href=""></a>-->
                    </div>
				</div>
			</article>
		</div>
	<? } ?>
</div>