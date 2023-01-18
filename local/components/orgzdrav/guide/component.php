<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Context;
use Bitrix\Main\SystemException;
use Orgzdrav\CrawlerDetect;
use Orgzdrav\Tables\AnonymousCounterTable;

if (!isset($arParams["SETTINGS"]) || !is_array($arParams["SETTINGS"])) {
	throw new SystemException("Component orgzdrav:guide settings missing");
}

$guideSettings = false;
$request = Context::getCurrent()->getRequest();

list($guideId, $guideEntityId, $entityAnchor) = explode('/', trim($request->getRequestUri(), '/'), 3);

foreach ($arParams["SETTINGS"] as $setting) {
	if ($setting['guide'] === $guideId) {
		$guideSettings = $setting;
		break;
	}
}

if (false === $guideSettings) {
	$this->AbortResultCache();
    
	@define('ERROR_404', 'Y');
	@define("BX_URLREWRITE", true);
	
	\CHTTP::setStatus("404 Not Found");
	\Bitrix\Main\Page\Frame::setEnable(false);
	
	require(\Bitrix\Main\Application::getDocumentRoot()."/404.php");
	
	exit;
}

$arParams["GUIDE"] = $guideId;

$componentPage = 'list';
if ($guideEntityId && is_numeric($guideEntityId)) {
	$componentPage = 'detail';
	
	$arParams["ENTITY_ID"] = $guideEntityId;
	$arParams["ANCHOR"] = $entityAnchor;
	
	global $USER;
	
	$arParams['FULL_ACCESS'] = $USER->IsAuthorized();
	
	if (false == $arParams['FULL_ACCESS']) {
		$arParams['FULL_ACCESS'] = CrawlerDetect::isFrendlyBot();
	}
	/*if (false == $arParams['FULL_ACCESS']) {
		$maxFullAcceess = 3;
		
		
		$userAcccessCount = AnonymousCounterTable::getCurrentCountByIp($_SERVER['REMOTE_ADDR'], $maxFullAcceess);
		
		$arParams['FULL_ACCESS'] = $maxFullAcceess >= $userAcccessCount;
	}*/
} else {
	$arParams['SEF_FOLDER'] = '/'.$arParams["GUIDE"].'/';
	$arParams['FIELDS'] = empty($guideSettings['list_fields']) ? [] : $guideSettings['list_fields'];
}

$this->includeComponentTemplate($componentPage);