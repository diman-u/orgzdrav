<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
CJSCore::Init(['jquery']);
?>

<div data-options = "region: 'east', title: 'Статистика продаж', split: true">
    <div id="charts" style="min-width: 100%; height: 500px; max-width: 800px; margin: 20px auto"></div>
</div>

<script>
    window.orgzdrav_chartsdata = <?= $arResult['DISPLAY_PROPERTIES']['DATA']['~VALUE'] ?>;
</script>
