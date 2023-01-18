<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$parser = new \CTextParser;

foreach ($arResult['ITEMS'] as $i => $item) {
	$item->description = $parser->html_cut($item->description, 200);
}