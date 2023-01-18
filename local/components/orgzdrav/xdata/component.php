<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Context;
use Bitrix\Main\SystemException;

if (!isset($arParams["DRIVER"]) || !isset($arParams["FROM"])) {
	throw new SystemException("Component vshouz:xdata settings missing");
}

$urlTemplates = array_merge([
	"list" => "",
	"section" => "",
	"detail" => "#ENTITY_ID#/",
], $arParams['SEF_URL_TEMPLATES']);

$engine = new CComponentEngine($this);

if (isset($arParams['SECTIONS'])) {
	if (!empty($arParams['SECTIONS']['IBLOCK_ID']) && CModule::IncludeModule('iblock')) {
		$this->arParams['IBLOCK_ID'] = $arParams['SECTIONS']['IBLOCK_ID'];
		$this->arParams['DETAIL_STRICT_SECTION_CHECK'] = 'Y';
		
		$engine->addGreedyPart('#SECTION_CODE_PATH#');
		$engine->setResolveCallback(['CIBlockFindTools', 'resolveComponentEngine']);
	}
}

$arResult = [];
$urlVariables = [];

$componentPage = $engine->guessComponentPath(
	$arParams["SEF_FOLDER"],
	$urlTemplates,
	$urlVariables
);

if (!$componentPage) {
	$componentPage = 'list';
}

if ('detail' != $componentPage) {
	$arParams['SELECT'] =  $arParams['SELECT'] ?? [];
	$arParams['FILTER'] =  $arParams['FILTER'] ?? [];
}

$arResult['VARIABLES'] = $urlVariables;

$this->includeComponentTemplate($componentPage);