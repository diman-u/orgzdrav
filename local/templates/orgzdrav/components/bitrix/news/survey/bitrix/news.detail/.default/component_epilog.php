<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset; 

Asset::getInstance()->addString('<script async src="https://survey.vshouz.ru/runner/app.js"></script>');