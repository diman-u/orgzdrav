<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->SetPageProperty('HIDE_H1', 'Y');

\Orgzdrav\Support\Counter::display('iblock', $arResult['ID']);

/** news block */
if (empty($arResult['PRICES'])) :
	\Bitrix\Main\UI\Extension::load("orgzdrav.news-small");
?><script type="text/javascript">
$(function() {
    const sidebar = new BX.Orgzdrav.SidebarNewsSmall('#news-sidebar');
    sidebar.start(['#news-small-1'], 10);
});
</script><?
endif;

/** gallery */
if ($arResult['HAS_GALLERY']) :
	\Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/vendor/swiper/swiper-bundle.min.css');
	\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/vendor/swiper/swiper-bundle.min.js');
	
?><script>
$(function() {
	const swiper = new Swiper('.content-swiper', {
		loop: true,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		}
	});
});
</script><?
endif;