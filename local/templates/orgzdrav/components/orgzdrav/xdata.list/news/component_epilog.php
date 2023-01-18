<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Orgzdrav\Tables\ViewCounterTable;

$APPLICATION->AddHeadString('<link rel="canonical" href="https://www.orgzdrav.com' . str_replace('index.php', '', $APPLICATION->GetCurPage(true)) . '" />');

/*$counters = [];

foreach ($arResult['ITEMS'] as $item) {
    $tems[] = $item['id'];
}

if (!empty($tems)) {
    $counters = ViewCounterTable::getMany('wcs_news', $tems);
}*/


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
<? /*<script>
    (function() {
        const counters = <?= json_encode($counters) ?>;
		Object.keys(counters).forEach(function(id) {
			$('.news-item[data-id="'+id+'"] .post-meta__cnt').text(counters[id]);
		});
    })();
</script> */ ?>