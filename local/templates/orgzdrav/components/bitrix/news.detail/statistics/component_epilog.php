<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->SetPageProperty('HIDE_H1', 'Y');

\Orgzdrav\Support\Counter::display('iblock', $arResult['ID']);

if (!empty($arResult['ENTITY_ID'])) :
	$params = explode('#', $arResult['ENTITY_ID']);
	
	$APPLICATION->IncludeComponent(
		"wellcomes:guide.detail",
		"",
		[
			"MODEL" => "\Orgzdrav\Wellcomes\Models\Manuscript",
			"ENTITY_ID" => $arResult['ENTITY_ID'],
			"DATE_FORMAT" => "d F Y",
			"CACHE_TYPE" => "Y",
			"CACHE_TIME" => 600,
		],
		false
	);
endif;
?>
	</div>
</article>