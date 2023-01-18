<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult['~PREVIEW_TEXT'] = preg_replace('#<a (.*?)href=[\'"](http[^\'"]+)[\'"][^>]*>(.+?)</a>#i', '<!--noindex--><a $1href="$2" rel="nofollow" target="_blank">$3</a><!--/noindex-->', $arResult['~PREVIEW_TEXT']);

$arResult['~DETAIL_TEXT'] = preg_replace('#<a (.*?)href=[\'"](http[^\'"]+)[\'"][^>]*>(.+?)</a>#i', '<!--noindex--><a $1href="$2" rel="nofollow" target="_blank">$3</a><!--/noindex-->', $arResult['~DETAIL_TEXT']);