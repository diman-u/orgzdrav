<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;

class COrgzdravGuide extends \CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
    {
		if (!isset($arParams["SETTINGS"]) || !is_array($arParams["SETTINGS"])) {
			throw new SystemException("Component orgzdrav:guide settings missing");
		}
		
		return $arParams;
    }
	
	
}