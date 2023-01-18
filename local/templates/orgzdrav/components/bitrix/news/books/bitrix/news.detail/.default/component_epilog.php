<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Orgzdrav\Tables\ViewCounterTable;
use Orgzdrav\Helper\Format;

$APPLICATION->SetPageProperty('HIDE_H1', 'Y');

$counter = ViewCounterTable::getCurrentCountAndInc('IBLOCK', $this->arParams['ELEMENT_ID']);
?>

<script>
    $('.post .post-meta__cnt').text(<?= Format::number($counter) ?>);
</script>
