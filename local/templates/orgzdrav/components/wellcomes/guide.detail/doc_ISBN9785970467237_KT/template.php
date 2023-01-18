<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!function_exists('docOutput')) :
function docOutput($section, $level = 1)
{
	if (!is_array($section)) {
		return;
	}
	
	if (!empty($section['id']) && 2 == $level) {
		print sprintf('<a name="%s"></a>', $section['id']);
	}
	if (!empty($section['head']) && 1 < $level) {
		print sprintf('<h%2$d>%1$s</h%2$s>', $section['head'], $level + 1);
	}
	
	foreach ($section['body'] as $element) : 	
		switch ($element['type']) {
			case 'section':
				docOutput($element['value'], $level + 1);
				break;
			default:
				print '<div class="js-doc-txt">'.$element['value'].'</div>';
				break;
		}
	endforeach;
}
endif;

?>
<div class="post-info">
	<? if (!empty($arResult['title'])) : ?>
		<div class="post-info__title"><?= $arResult['title'] ?></div>
	<? endif; ?>
	<div class="post-info__value">Источник: <strong>Общественное здоровье и здравоохранение. Национальное руководство</strong></div>
	<div class="post-info__value">ISBN: <strong>978-5-9704-6723-7</strong></div>
	<div class="post-info__value">Автор: <strong>гл. ред. Г. Э. Улумбекова, В. А. Медик</strong></div>
</div>
<? if ($arResult['MENU']) : ?>
	<div class="post-menu">
        <ul>
			<? foreach($arResult['MENU'] as $anchor => $title)  : ?>
            <li><a href="#<?= $anchor ?>"><?= $title ?></a></li>
			<? endforeach; ?>
        </ul>
	</div>
<? endif; ?>
<div class="post__content js-doc-workspace">
	<? docOutput($arResult); ?>
</div>