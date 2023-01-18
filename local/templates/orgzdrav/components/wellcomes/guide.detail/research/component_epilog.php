<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$APPLICATION->SetPageProperty('HIDE_H1', 'Y');

\Orgzdrav\Support\Counter::display($arResult['guide'], $arResult['id']);
?>
</article>

<hr />

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