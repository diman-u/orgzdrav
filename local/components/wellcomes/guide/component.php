<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Context;
use Bitrix\Main\SystemException;
use Orgzdrav\WellcomesManager;

if (!isset($arParams['MODEL']) || !class_exists($arParams['MODEL'])) {
	throw new SystemException("Model class not found");
}

if (!empty($arParams['CONFIG'])) {
	$config = WellcomesManager::config($arParams['CONFIG']);
	$arParams = array_merge($config, $arParams);
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
	$arParams['SELECT'] = $arParams['SELECT'] ?? [];
	$arParams['FILTER'] = $arParams['FILTER'] ?? [];
}

$arResult['VARIABLES'] = $arParams['VARIABLES'] = $urlVariables;

$this->includeComponentTemplate($componentPage);