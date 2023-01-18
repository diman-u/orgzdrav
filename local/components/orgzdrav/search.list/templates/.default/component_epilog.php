<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Orgzdrav\Tables\ViewCounterTable;

$arrCounts = array_replace($arResult['DATA_SEARCH']['LIST_ARTICLE_ID'], $arResult['DATA_SEARCH']['LIST_NEWS_ID']);
?>

<script>
(function() {
    const counters = <?= json_encode($arrCounts) ?>;
    $('.event-item[id]').each(function() {
        let id = this.id;
        $('.post-meta .post-meta__cnt', this).text(counters[id]);
    });
})();
</script>