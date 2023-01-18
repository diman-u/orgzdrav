<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>

<div data-options = "region: 'east', title: 'Статистика продаж', split: true">
    <div id="charts" style="min-width: 100%; height: 800px; margin: 20px auto"></div>
</div>

<script>
    window.ORGZDRAV = window.ORGZDRAV || {};
	window.ORGZDRAV.chartsdata = <?= json_encode($arResult['chartsdata']) //$arResult['DISPLAY_PROPERTIES']['DATA']['~VALUE'] ?>;
</script>
