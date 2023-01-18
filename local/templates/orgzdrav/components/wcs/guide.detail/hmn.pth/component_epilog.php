<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

\Bitrix\Main\Page\Asset::getInstance()->addString('<script src="https://unpkg.com/@popperjs/core@2"></script>');
\Bitrix\Main\Page\Asset::getInstance()->addString('<script src="https://unpkg.com/tippy.js@6"></script>');

\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/vendor/viewerjs/viewer.min.js');
\Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/vendor/viewerjs/viewer.min.css');

\Bitrix\Main\Loader::includeModule('orgzdrav');
$client = new \Orgzdrav\Gate22\WellcomesClient('orgzdrav', 'test');

$config = [];
$config['url'] = 'http://gate22.wellcomes.ru/';
$config['ssr'] = $client->getSession();
$config['guide'] = $arParams['GUIDE'];
$config['entity_id'] = $arParams['ENTITY_ID'];
$config['anchor'] = $arParams['ANCHOR'];

?>
<script type="text/javascript">
	window.gate22 = <?=CUtil::PhpToJSObject($config)?>;
</script>
<script id="thesaurus-template" type="x-tmpl-mustache">
<div class="card">
	<div class="card-body">
		<h5 class="card-title">{{ term }}</h5>
		{{#sin}}<h6 class="card-subtitle mb-2 text-muted">{{ sin }}</h6>{{/sin}}
		<p class="card-text">{{{ definition }}}</p>
	</div>
</div>
</script>
<script id="attache-template" type="x-tmpl-mustache">
<div class="card">
	<div class="card-body">
		<img class="js-attache-img" src="{{ thumb }}" data-original="{{ url }}" alt="" />
	</div>
</div>
</script>