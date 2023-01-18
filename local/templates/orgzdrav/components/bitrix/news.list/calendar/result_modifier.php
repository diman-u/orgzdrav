<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$typeThemeClasses = [
	'online'  => 'theme-blue',
	'offline' => 'theme-dark'
];

foreach ($arResult['ITEMS'] as &$arItem) {
	$arItem['DISPLAY_PROPERTIES']['type']['CLASS'] = $typeThemeClasses[$arItem['DISPLAY_PROPERTIES']['type']['VALUE_XML_ID']];
}