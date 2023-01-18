<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Page\Asset;

$APPLICATION->SetPageProperty('HIDE_H1', 'Y');

Asset::getInstance()->addString('<script src="https://unpkg.com/@popperjs/core@2"></script>');
Asset::getInstance()->addString('<script src="https://unpkg.com/tippy.js@6"></script>');
Asset::getInstance()->addString('<script src="https://www.unpkg.com/mustache@4.2.0/mustache.min.js"></script>');

?>
<script id="thesaurus-template" type="x-tmpl-mustache">
<div class="card card--slim">
	<div class="card-body">
		<h5 class="card-title">{{ term }}</h5>
		{{#sin}}<h6 class="card-subtitle mb-2 text-muted">{{ sin }}</h6>{{/sin}}
		<p class="card-text">{{{ definition }}}</p>
	</div>
</div>
</script>