<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class OrgzdravAuthComponent extends \CBitrixComponent
{
	public function executeComponent()
    {
		\Bitrix\Main\UI\Extension::load("orgzdrav.controls");
		
		$this->includeComponentTemplate();
    }
}