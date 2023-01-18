<?  if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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

<?$APPLICATION->IncludeComponent(
    'orgzdrav:universal',
    'search.page',
    [
        'TEMPLATE_TYPE' => '',
        'LIST_ENTITY' => $arResult['DATA_SEARCH']['NEWS']
    ]
);?>


<?
if ($isAjaxLoadMore) {
    $APPLICATION->FinalActions();
    exit;
}
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:main.pagenavigation",
    "infinite",
    array(
        "NAV_OBJECT" => $arResult['NAV'],
        "SEF_MODE" => "N",
    ),
    false
);?>

