<? 
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arResult['ITEMS_BY_SECTION'] = [];

$res = CIBlockElement::GetList(
	[
		'SORT' => 'ASC'
	], 
	[
		'IBLOCK_ID' => $arParams['IBLOCK_ID'],
		'ACTIVE' => 'Y'
	],
	false,
	false,
	['ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'NAME', 'DETAIL_PAGE_URL', 'PROPERTY_xdata_id']
);

while ($ob = $res->GetNextElement(false, false)) {
	$row = $ob->GetFields();
	$arResult['ITEMS_BY_SECTION'][$row['IBLOCK_SECTION_ID']][] = $row;
}

unset($res, $row);