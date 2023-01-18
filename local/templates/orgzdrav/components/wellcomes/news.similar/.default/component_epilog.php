<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Orgzdrav\Tables\ViewCounterTable;

if (!empty($arResult['IDS'])) :
    $counters = ViewCounterTable::getMany('wcs_news', $arResult['IDS']);
?>
<script>
    (function() {
        const counters = <?= json_encode($counters) ?>;
		Object.keys(counters).forEach(function(id) {
			$('.news-item[data-id="'+id+'"] .post-meta__cnt').text(counters[id]);
		});
    })();
</script>
<?endif;?>
