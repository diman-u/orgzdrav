<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (!empty($arParams['CHECK_SECTION_DESCRIPTION']) && !empty($arResult['SECTION']['PATH'][0]['DESCRIPTION'])) {
	$this->__component->arResult['SECTION_DESCRIPTION'] = $arResult['SECTION']['PATH'][0]['~DESCRIPTION'];
	$this->__component->SetResultCacheKeys(['SECTION_DESCRIPTION']);
}