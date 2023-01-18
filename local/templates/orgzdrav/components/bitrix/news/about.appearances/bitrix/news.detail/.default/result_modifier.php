<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult['~DETAIL_TEXT'] = preg_replace('#<a (.*?)href=[\'"](http[^\'"]+)[\'"][^>]*>(.+?)</a>#i', '<!--noindex--><a $1href="$2" rel="nofollow" target="_blank">$3</a><!--/noindex-->', $arResult['~DETAIL_TEXT']);

if (! empty($arResult['DISPLAY_PROPERTIES']['YOUTUBE']['VALUE'])) {   
	$value = $arResult['DISPLAY_PROPERTIES']['YOUTUBE']['VALUE'];
	
	if (preg_match('#youtu.be/([^?]+)#i', $value, $m)) {
		$value = 'https://www.youtube.com/embed/'.$m[1];
	} elseif (preg_match('#watch\?v=([^&]+)#i', $value, $m)) {
		$value = 'https://www.youtube.com/embed/'.$m[1];
	}
	
	if (false === strpos($value, 'https')) {
		$value = 'https://www.youtube.com/embed/'.$value;
	}
	
	$arResult['DISPLAY_PROPERTIES']['YOUTUBE']['VALUE'] = $value;
}