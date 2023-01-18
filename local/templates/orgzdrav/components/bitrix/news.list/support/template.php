<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<ul class="list-deep">
<? foreach ($arResult['ITEMS'] as $arItem) : ?>
	<li><a class="h5 link-text js-support-item" href="<?= $arItem['DETAIL_PAGE_URL'] ?>" data-docid="<?= $arItem['PROPERTIES']['xdata_id']['VALUE'] ?>"><?= $arItem['NAME'] ?></a></li>
<? endforeach; ?>
</ul>
<template id="loading-tpl">
	<div class="spinner-block mt-12 mb-12">
		<strong>Загрузка...</strong>
		<div class="spinner" role="status"></div>
	</div>
</template>