<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<article class="post content post--education" data-type="iblock" data-id="<?= $arResult['ID'] ?>">
	<h1><?= $arResult['NAME'] ?></h1>
    <div class="post-meta">
        <div class="post-meta__tag">Видео</div>
        <div class="post-meta__txt"><?= $arResult['DATE_BEGIN'] ?></div>
        <div class="post-meta__cnt"></div>
    </div>

	<div class="grid-2col">
		<div class="grid-2col__column post">
            <div class="mt-4 mb-8 video__content">
                <div class="hidden">
                    <img src="<?= $arResult['PREVIEW_PICTURE']['SRC']; ?>">
                </div>

                <iframe allow="autoplay; encrypted-media" width="100%" height="400px"
                        src="https://vshouz.servicecdn.ru/videos/<?= $arResult['PROPERTIES']['VIDEO_ID']['VALUE'] ?>"
                        frameborder="0" allowfullscreen style="border: none;">
                </iframe>
            </div>

            <ul class="tabs-nav" data-target="#video-tabs">
                <li class="tabs-nav__item tabs-nav__item--active">
                    <a href="#">Описание</a></li>
                <li class="tabs-nav__item">
                    <a href="#">Резюме</a>
                </li>
            </ul>

            <div class="tab-content" id="video-tabs">
				<div class="tab-content__pane tab-content__pane--active post__content">
					<?= $arResult['DETAIL_TEXT'] ?>
				</div>
				<div class="tab-content__pane tab-content__pane">
					<?= $arResult['PROPERTIES']['REZUME']['~VALUE']['TEXT'] ?>
				</div>
			</div>

            <h3>Спикеры</h3>
            <div class="js-hidden">
                <?php foreach ($arResult['SPEAKERS'] as $item): ?>
                <div class="person">
                    <div class="person__media">
                        <img alt="" src="<?= $item['IMAGE']?>">
                    </div>
                    <div class="person__info">
                        <div class="person__title"><?= $item['NAME']?></div>
                        <div class="person__subtitle"><?= $item['POST']?></div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
<? $this->SetViewTarget('aside-card'); ?>
<div class="card">
	<h4>Дата проведения</h4>
	<div class="post-meta__txt">
		<span>Начало: </span>
		<span><?= $arResult['DATE_BEGIN'] ?></span>
	</div>
	<div class="post-meta__txt">
		<span>Окончание: </span>
		<span><?= $arResult['DATE_END'] ?></span>
	</div>
</div>
<? $this->EndViewTarget(); ?>