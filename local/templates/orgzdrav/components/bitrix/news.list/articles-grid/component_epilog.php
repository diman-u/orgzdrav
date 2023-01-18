<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Orgzdrav\Tables\ViewCounterTable;

$counters = ViewCounterTable::getMany('IBLOCK', $arResult['ELEMENTS']);
?>
<script>
    (function() {
        const counters = <?= json_encode($counters) ?>;
		Object.keys(counters).forEach(function(id) {
			$('.article-item[data-id="'+id+'"] .post-meta__cnt').text(counters[id]);
		});
    })();
</script>