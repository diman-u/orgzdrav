<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!empty($arResult['PREVIEW_PICTURE']['SRC'])) {
	\Bitrix\Main\Page\Asset::getInstance()->addString('<meta property="og:image" content="https://www.orgzdrav.com'.$arResult['PREVIEW_PICTURE']['SRC'].'">');
}

\Orgzdrav\Support\Counter::display('iblock', $arResult['ID']);