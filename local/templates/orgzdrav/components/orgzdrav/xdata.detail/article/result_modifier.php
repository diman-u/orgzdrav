<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


if (!empty($arParams['ENTITY_SECTION'])) {
	$arResult['body'] = array_filter($arResult['body'], function($section) use ($arParams) {
		return $arParams['ENTITY_SECTION'] == $section['id'];
	});
	
	if (count($arResult['body'])) {
		$section = current($arResult['body']);
		
		$arResult['subtitle'] = $section['value']['head'];
		$arResult['body'] = $section['value']['body'];
	}
}