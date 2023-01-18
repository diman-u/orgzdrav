<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class OrgzdravDocReaderComponent extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }
	
	public function executeComponent()
    {
		//\Bitrix\Main\UI\Extension::load("orgzdrav.doc-reader");
		
		$this->includeComponentTemplate();
    }
}