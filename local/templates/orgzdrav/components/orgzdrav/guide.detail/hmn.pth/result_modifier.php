<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

prepareFieldsContent($arResult);

function prepareFieldsContent(&$fields)
{
	foreach ($fields as &$field) {
		$field['value'] = str_replace('src="attache:', 'data-src="attache:', $field['value']);
		
		
		if (!empty($field['fields'])) {
			prepareFieldsContent($field['fields']);
		}
	}
}