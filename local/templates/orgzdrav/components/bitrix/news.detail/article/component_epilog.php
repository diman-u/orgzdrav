<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->SetPageProperty('HIDE_H1', 'Y');

\Orgzdrav\Support\Counter::display('iblock', $arResult['ID']);

if (!empty($arResult['xdata_id'])) :
	$params = explode('#', $arResult['xdata_id']);

	$APPLICATION->IncludeComponent(
		"wellcomes:guide.detail", 
		"doc_ISBN9785970467237_KT",
		[
			"MODEL" => "\Orgzdrav\Wellcomes\Models\Support",
			"ENTITY_ID" => $params[0],
			"ENTITY_SECTION" => $params[1] ?? false,
			"CACHE_TYPE" => "Y",
			"CACHE_TIME" => 3600,
		], 
		false
	);
endif;
?>
    <footer>
		<? $APPLICATION->ShowViewContent('article-footer'); ?>
		
        <?
//        $APPLICATION->IncludeComponent("ylab:likes", "", [
//			'ELEMENT_ID' => $arResult['ID'],
//			'ENTITY_ID' => $arParams['IBLOCK_ID'],
//			'SHOW_DISLIKE' => 'Y',
//			'CACHE_TYPE' => 'А',
//			'CACHE_TIME' => 300
//		]);
        ?>
    </footer>
</article>