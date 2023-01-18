<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
$items = $arResult['ARHIVE'] ? $arResult['ARHIVE_ITEMS'] : $arResult['ITEMS'];
?>
<div class="section-tabs">
    <ul>
        <li class="<?= $arResult['ARHIVE'] ? '' : 'section-tabs__active' ?>"><a href="/test/calendar/">Будущие</a></li>
        <li class="<?= $arResult['ARHIVE'] ? 'section-tabs__active' : '' ?>"><a href="/test/calendar/arhive/?deb=Y">Прошедшие</a></li>
    </ul>
</div>
<div class="grid grid--xl-3">
	<? foreach ($items as $i => $item): ?>
		<div class="grid__column">
            <article class="event-item js-cnt" data-type="<?= $arParams['GUIDE'] ?>" data-id="<?= $item['id'] ?>">
                <div class="event-item__img">
					<img src="<?= $item['photos']['asis'] ?>" alt="<?= htmlspecialchars($item["header"]) ?>" />
					<? if (preg_match('/(очно|онлайн|online)/ui', $item['format']['value'])) : ?>
                    <div class="event-item__img-badge theme-blue">Online</div>
					<? else : ?>
					<div class="event-item__img-badge theme-dark">Offline</div>
					<? endif; ?>
                </div>
                <div class="event-item__content">
                    <a href="<?= $item['detail_url'] ?>" class="event-item__title u-link-holder"><?= $item['header'] ?></a>
                    <p><?= strip_tags($item['annotation']) ?></p>
                    <div class="event-item__value">Проводим: <span><?= $item['place']['value'] ?></span></div>

                    <div class="post-meta">
                        <div class="post-meta__tag is-big">Мероприятия Тест</div>
                        <div class="post-meta__txt">
                            <? if ($item['idx_key_date'] == $item['idx_key_date_end'] || !$item['idx_key_date_end']): ?>
                                <?= FormatDate('d F Y', strtotime($item['idx_key_date'])) ?>
                            <? else: ?>
                                <?= FormatDate('d', strtotime($item['idx_key_date'])) ?> -
                                <?= FormatDate('d F Y', strtotime($item['idx_key_date_end'])) ?>
                            <? endif; ?>
                        </div>
                        <div class="post-meta__cnt"></div>
                    </div>
                </div>
            </article>
		</div>
	<? endforeach; ?>
</div>