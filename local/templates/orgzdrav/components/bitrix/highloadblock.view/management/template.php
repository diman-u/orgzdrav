<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult['ERROR'])) {
	ShowError($arResult['ERROR']);
	return false;
}

global $USER_FIELD_MANAGER;

?>
<article class="news-item">
	<div class="news-item__img news-item__img--small">
		<?= $USER_FIELD_MANAGER->getListView(
			$arResult['fields']['UF_IMAGE'], 
			$arResult['row']['UF_IMAGE']
		) ?>
	</div>
	<div class="news-item__content">
		<?= htmlspecialchars_decode(
			html_entity_decode(
				$USER_FIELD_MANAGER->getListView(
					$arResult['fields']['UF_DESCRIPTION'], 
					$arResult['row']['UF_DESCRIPTION']
				)
			)
		) ?>
		
		<? if (!empty($arParams['BIO_LINK'])) : ?>
		<p class="text-right">
			<a class="btn btn--light" href="<?= $arParams['BIO_LINK'] ?>">Читать биографию</a>
		</p>
		<? endif ?>
	</div>
</article>