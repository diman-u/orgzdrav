<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult['ENTITY_ID'] = $arResult['PROPERTIES']['ENTITY_ID']['VALUE'] ?? false;
$this->__component->SetResultCacheKeys(['ENTITY_ID']);