<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult['DESCRIPTION'])) {
	$this->__component->SetResultCacheKeys(['DESCRIPTION']);
}