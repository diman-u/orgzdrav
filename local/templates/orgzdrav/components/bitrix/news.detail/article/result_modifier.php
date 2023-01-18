<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult['xdata_id'] = $arResult['PROPERTIES']['xdata_id']['VALUE'] ?? false;
$this->__component->SetResultCacheKeys(['xdata_id']);