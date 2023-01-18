<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;

\Bitrix\Main\UI\Extension::load("orgzdrav.statistics");

?>
<script>(new BX.Orgzdrav.Statistics('statistics'));</script>
