<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;

if (true === $arResult['USE_LOGIC']) {
	Asset::getInstance()->addString('<script src="https://unpkg.com/@popperjs/core@2"></script>');
	Asset::getInstance()->addString('<script src="https://unpkg.com/tippy.js@6"></script>');
	
	
	\Bitrix\Main\UI\Extension::load("ui.vue");
	
	Asset::getInstance()->addJs($templateFolder.'/logic/'.$arResult['CODE'].'/script.js');
}

/*\Bitrix\Main\UI\Extension::load("orgzdrav.calculator.components.result");
\Bitrix\Main\UI\Extension::load("orgzdrav.calculator.polyclinic");
?>
<script type="text/javascript">
    const app = new BX.Orgzdrav.Calculator('#calc');
</script>*/