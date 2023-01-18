<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Orgzdrav\Tables\ViewCounterTable;

$counters = ViewCounterTable::getMany('IBLOCK', $arResult['ELEMENTS']);

?>

<script>
(function() {
    const counters = <?= json_encode($counters) ?>;
    $('.event-item[id]').each(function() {
        let id = this.id;
        $('.post-meta__cnt', this).text(counters[id]);
    });
})();
</script>