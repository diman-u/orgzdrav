<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>

<?if (empty($arResult['NOT_FOUND'])):
    $APPLICATION->SetTitle("Результаты по запросу «". $arResult['SEARCH_TERMS']['PARAMS']['SEARCH'] ."»");
?>
    <ul class="tabs-nav tabs-nav--left tabs-nav--section-hr">
        <li class="tabs-nav__item <?= empty($arResult['TYPE']) ? 'tabs-nav__item--active' : ''; ?>">
            <a href="<?= $APPLICATION->GetCurDir()?>?search=<?= $arResult['SEARCH_TERMS']['PARAMS']['SEARCH'] ?>">Все материалы</a>
        </li>
        <? foreach ($arResult['SEARCH_TERMS']['COUNTS'] as $key => $item): ?>
            <? if(!empty($item['COUNT'])): ?>
                <li class="tabs-nav__item <?= $arResult['TYPE'] == $key  ? 'tabs-nav__item--active' : ''; ?>">
                    <a href="<?= $APPLICATION->GetCurDir()?>?search=<?= $arResult['SEARCH_TERMS']['PARAMS']['SEARCH'] ?>&type=<?= $key ?>" >
                        <?= $item['TITLE'] ?>・<?= $item['COUNT'] ?>
                    </a>
                </li>
            <? endif; ?>
        <? endforeach; ?>
    </ul>

    <? if (empty($arResult['TYPE']) && !(empty($arResult['SEARCH_TERMS']['DESC']) && empty($arResult['SEARCH_TERMS']['TERMS']))): ?>
        <? if($arResult['SEARCH_TERMS']['DESC']): ?>
        <div class="hero content">
            <h2><?= $arResult['SEARCH_TERMS']['PARAMS']['SEARCH'] ?></h2>
            <p><?= $arResult['SEARCH_TERMS']['DESC']; ?></p>
        </div>
        <? endif; ?>

        <div class="grid grid--gap grid--xl-3 grid--full-height">
            <? foreach ($arResult['SEARCH_TERMS']['TERMS'] as $item): ?>
                <div class="grid__column">
                    <a href="/search/?search=<?= $item ?>" class="btn-icon">
                        <i class="icon icon--blue icon--md-search"></i>
                        <span class="btn-icon__inner"><?= $item ?></span>
                    </a>
                </div>
            <? endforeach; ?>
        </div>
		
		<hr class="my-section" />
    <? endif; ?>
<? else:
    $APPLICATION->SetTitle($arResult['NOT_FOUND']);
    ?>
<? endif; ?>

<?
$isAjaxLoadMore = isset($_REQUEST['load_more']);

if ($isAjaxLoadMore)
	$APPLICATION->RestartBuffer();
?>

<? if (!empty($arResult['DATA_SEARCH']['ARTICLES'])): ?>
	<? if (empty($arResult['TYPE'])): ?>
    <header>
        <h3>Статьи по теме</h3>
        <a
            href="<?= $APPLICATION->GetCurDir()?>?search=<?= $arResult['SEARCH_TERMS']['PARAMS']['SEARCH'] ?>&type=st1"
            class="btn btn--light"
        >
            Смотреть все
        </a>
    </header>
	<? endif; ?>
    <div class="grid grid--xl-3 js-is-container">
        <? foreach ($arResult['DATA_SEARCH']['ARTICLES'] as $id => $arItem): ?>
        <div class="grid__column js-is-container-item">
            <article class="event-item" id="<?= $arItem["ID"] ?>">
                <div class="event-item__img">
                    <img src="<?= $arItem["PREVIEW_PICTURE"]; ?>" alt="<?= htmlspecialchars($arItem["NAME"]) ?>" />
                </div>
                <div class="event-item__content">
                    <a class="event-item__title u-link-holder" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
                    <p><?= $arItem["PREVIEW_TEXT"] ?></p>
                    <div class="post-meta">
                        <div class="post-meta__tag is-big">Статья</div>
                        <div class="post-meta__txt"><?= $arItem["DISPLAY_CREATED"] ?></div>
                        <div class="post-meta__cnt"></div>
                    </div>
                </div>
            </article>
        </div>
        <? endforeach; ?>
    </div>
	<? if (!empty($arResult['DATA_SEARCH']['NEWS'])): ?><hr class="my-section" /><? endif; ?>

<? endif; ?>

<? if (!empty($arResult['DATA_SEARCH']['NEWS'])): ?>
	<? if (empty($arResult['TYPE'])): ?>
    <header>
        <h3>Новости по теме</h3>
        <a
                href="<?= $APPLICATION->GetCurDir()?>?search=<?= $arResult['SEARCH_TERMS']['PARAMS']['SEARCH'] ?>&type=st2"
                class="btn btn--light"
        >
            Смотреть все
        </a>
    </header>
	<? endif; ?>
	
    <div class="grid grid--xl-3 js-is-container">
        <? foreach ($arResult['DATA_SEARCH']['NEWS'] as $id => $arItem): ?>
        <div class="grid__column js-is-container-item">
            <article class="event-item" id="<?= $id ?>">
                <div class="event-item__img">
                    <img src="<?= $arItem["photos"]["asis"]; ?>" alt="<?= htmlspecialchars($arItem["header"]) ?>" />
                </div>
                <div class="event-item__content">
                    <a class="event-item__title u-link-holder" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["header"] ?></a>
                    <p><?= $arItem["announcement"] ?></p>

                    <div class="post-meta">
                        <div class="post-meta__tag is-big">Новость</div>
                        <div class="post-meta__txt"><?= $arItem["DISPLAY_CREATED"] ?></div>
                        <div class="post-meta__cnt"></div>
                    </div>
                </div>
            </article>
        </div>
        <? endforeach; ?>
    </div>
<? endif; ?>

<?
if ($isAjaxLoadMore) {
    $APPLICATION->FinalActions();
    exit;
}
?>

<?if (!empty($arResult['TYPE'])): ?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.pagenavigation",
        "infinite",
        array(
            "NAV_OBJECT" => $arResult['NAV'],
            "SEF_MODE" => "N",
        ),
        false
    );?>
<? endif; ?>
