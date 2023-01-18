<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$APPLICATION->SetPageProperty('HIDE_H1', 'Y');

if (!empty($arResult['og:image'])) {
	\Bitrix\Main\Page\Asset::getInstance()->addString('<meta property="og:image" content="'.$arResult['og:image'].'">');
}

\Orgzdrav\Support\Counter::display($arResult['guide'], $arResult['id']);


?>
    <footer>
		<? $APPLICATION->ShowViewContent('news-footer'); ?>
		
		<?
//		if (defined('WCS_ENTITY_ID') && isset(WCS_ENTITY_ID[$arResult['guide']])) {
//			$APPLICATION->IncludeComponent("ylab:likes", "", [
//				'ELEMENT_ID' => $arResult['id'],
//				'ENTITY_ID' => WCS_ENTITY_ID[$arParams['FROM']],
//				'SHOW_DISLIKE' => 'Y',
//				'CACHE_TYPE' => 'А',
//				'CACHE_TIME' => 300
//			]);
//		}
		?>
    </footer>
</article>

<?$APPLICATION->IncludeComponent(
    "wellcomes:news.similar",
    "",
	array_merge($arParams, [
		"ELEMENT_ID" => $arResult['id'],
		"VARIABLES" => [
			'SECTION_CODE' => $arResult['SECTION']['CODE']
        ],
		"CACHE_TYPE" => "Y",
        "CACHE_TIME" => 300
	]),
    false
);?>