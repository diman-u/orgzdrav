<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$APPLICATION->SetPageProperty('HIDE_H1', 'Y');

\Orgzdrav\Support\Counter::display($arParams['FROM'], $arParams['ENTITY_ID']);
?>
    <footer>
		<? $APPLICATION->ShowViewContent('news-footer'); ?>
		
		<?
		if (defined('WCS_ENTITY_ID') && isset(WCS_ENTITY_ID[$arParams['FROM']])) {
			$APPLICATION->IncludeComponent("ylab:likes", "", [
				'ELEMENT_ID' => $arResult['id'],
				'ENTITY_ID' => WCS_ENTITY_ID[$arParams['FROM']],
				'SHOW_DISLIKE' => 'Y',
				'CACHE_TYPE' => 'А',
				'CACHE_TIME' => 300
			]);
		}
		?>
    </footer>
</article>


<?$APPLICATION->IncludeComponent(
    "wellcomes:news.similar",
    "wcs_news.mini",
    [
        "MODEL" => "\Orgzdrav\Wellcomes\Models\WcsNews",
        "ELEMENT_ID" => $arResult['id'],
        "SECTIONS" => [
            "IBLOCK_ID" => 2,
            "FILTER" => "UF_WCS_CONFIG",
            "ALLOW_ALL" => "Y",
            "GROUP_LIST" => "Y"
        ],
        "VARIABLES" => [
            'SECTION_CODE' => $arResult['SECTION']['CODE']
        ],

        "SELECT" => [
            'idx_key_date',
            'header',
            'type',
            'source',
            'ctr2',
            'h_sec',
            'main_feature',
            'photos',
            'annotation'
        ],
        "FILTER" => [
            'status' => 'on',
            'targets' => 'vshouz.ru'
        ],
        "SORT_BY" => "idx_key_date",
        "SORT_ORDER" => "dec",
        "LIMIT" => "4",

        "CACHE_TYPE" => "N",
        "CACHE_TIME" => 600
    ],
    false
);?>