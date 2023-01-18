<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$APPLICATION->SetPageProperty('HIDE_H1', 'Y');

\Orgzdrav\Support\Counter::display($arParams['FROM'], $arParams['ENTITY_ID']);
?>
    <footer>
		<? $APPLICATION->ShowViewContent('news-footer'); ?>
		
		<?
		if (defined('WCS_ENTITY_ID') && isset(WCS_ENTITY_ID[$arParams['FROM']])) {
//			$APPLICATION->IncludeComponent("ylab:likes", "", [
//				'ELEMENT_ID' => $arResult['id'],
//				'ENTITY_ID' => WCS_ENTITY_ID[$arParams['FROM']],
//				'SHOW_DISLIKE' => 'Y',
//				'CACHE_TYPE' => 'А',
//				'CACHE_TIME' => 300
//			]);
		}
		?>
    </footer>
</article>