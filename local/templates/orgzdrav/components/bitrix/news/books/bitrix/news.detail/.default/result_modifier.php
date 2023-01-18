<?php

use Orgzdrav\Helper\Format;

$dateBegin = new \Bitrix\Main\Type\DateTime($arResult['ACTIVE_FROM']);
$arResult['DATE_BEGIN'] = Format::getFormatDate($dateBegin->getTimestamp());

$dateEnd = new \Bitrix\Main\Type\DateTime($arResult['PROPERTIES']['DATE_END']['VALUE']);
$arResult['DATE_END'] = Format::getFormatDate($dateEnd->getTimestamp());