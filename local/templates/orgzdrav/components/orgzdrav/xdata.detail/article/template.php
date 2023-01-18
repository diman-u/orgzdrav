<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!function_exists('docOutput')) :
function docOutput($section, $level = 1)
{
	if (!is_array($section)) {
		return;
	}
	
	if (!empty($section['head']) && 1 < $level) {
		print sprintf('<h%2$d>%1$s</h%2$s>', $section['head'], $level);
	}
	
	foreach ($section['body'] as $element) : 	
		switch ($element['type']) {
			case 'section':
				docOutput($element['value'], $level + 1);
				break;
			default:
				print $element['value'];
				break;
		}
	endforeach;
}
endif;

docOutput($arResult);