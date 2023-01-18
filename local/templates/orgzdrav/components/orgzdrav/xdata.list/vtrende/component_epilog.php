<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/*use Orgzdrav\Tables\ViewCounterTable;

$tems = [];
foreach ($arResult['ITEMS'] as $item) {
    $tems[] = $item['id'];
}
$counters = ViewCounterTable::getMany('wcs_news', $tems);
?>
<script>
    (function() {
        const counters = <?= json_encode($counters) ?>;
        $('.news-item[data-id]').each(function() {
            let id = parseInt(this.getAttribute('data-id'));
            $('.post-meta .post-meta__cnt', this).text(counters[id] || 0);
        });
    })();
</script>*/