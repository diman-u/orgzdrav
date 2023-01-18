<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Orgzdrav\Helper\Format;

$format = new Format();

foreach ($arResult['ITEMS'] as $key => $item) {
    $dateTime = \Bitrix\Main\Type\DateTime::createFromPhp(new DateTime($item['idx_key_date']));
    $arResult['ITEMS'][$key]['idx_key_date'] = $format->getFormatDate($dateTime->getTimestamp());
}