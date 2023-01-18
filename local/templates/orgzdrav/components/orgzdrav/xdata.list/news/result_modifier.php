<?php

$format = new \Orgzdrav\Helper\Format();

foreach ($arResult['ITEMS'] as $key => $item) {
    $phpDateTime = new DateTime($item['idx_key_date']);
    $dateTime = \Bitrix\Main\Type\DateTime::createFromPhp($phpDateTime);
    $arResult['ITEMS'][$key]['idx_key_date'] = $format->getFormatDate($dateTime->getTimestamp());
}

if (!empty($arResult['SECTION_LIST'])) {
	foreach ($arResult['ITEMS'] as &$item) {
		$item['SECTION_NAME'] = $item['type'];
		
		if (
			empty($item['SECTION_ID'])
			|| empty($arResult['SECTION_LIST'][$item['SECTION_ID']])
		) {
			continue;
		}
		
		$item['SECTION_NAME'] = $arResult['SECTION_LIST'][$item['SECTION_ID']]['NAME'];
	}
}