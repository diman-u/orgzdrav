<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Context;
use Bitrix\Main\SystemException;
use Orgzdrav\CrawlerDetect;
use Orgzdrav\Tables\AnonymousCounterTable;

if (!isset($arParams["GUIDE"])) {
	throw new SystemException("Component wcs:guide settings missing");
}
if (!isset($arParams["USE_COUNTER"])) {
	$arParams["USE_COUNTER"] = false;
}

$guideSettings = false;
$request = Context::getCurrent()->getRequest();

$requestUrl = str_replace($arParams["SEF_FOLDER"], '', $request->getRequestUri());
list($guideEntityId, $entityAnchor) = explode('/', trim($requestUrl, '/'), 2);

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
	$arParams['FIELDS'] = empty($arParams['LIST_FIELDS']) ? [] : $arParams['LIST_FIELDS'];
	$arParams['SORT'] = empty($arParams['SORT']) ? [] : $arParams['SORT'];
}

$this->includeComponentTemplate($componentPage);