<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class OrgzdravAuthComponent extends \CBitrixComponent
{
	public function executeComponent()
    {
		\Bitrix\Main\Page\Asset::getInstance()
			->addString('<script src="https://www.google.com/recaptcha/api.js?render='.RECAPTCHA_V3_SITEKEY.'"></script>');
		\Bitrix\Main\UI\Extension::load("orgzdrav.auth");
		
		$this->includeComponentTemplate();
    }
}