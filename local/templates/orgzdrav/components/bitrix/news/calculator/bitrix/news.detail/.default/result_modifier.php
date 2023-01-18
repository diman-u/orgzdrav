<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult['DIR_LOGIC'] = __DIR__ . '/logic/'.$arResult['CODE'];
$arResult['USE_LOGIC'] = is_dir($arResult['DIR_LOGIC']) && file_exists($arResult['DIR_LOGIC'].'/template.php');

$this->__component->SetResultCacheKeys(['CODE', 'USE_LOGIC']);