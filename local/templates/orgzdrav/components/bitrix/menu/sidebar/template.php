<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);
?>
<? if (!empty($arResult)): ?>
<nav class="sidebar-nav">
    <ul>
<?
$previousLevel = 0;
foreach($arResult as $arItem):
	$class = [];
	$attrs = [];

	if ($arItem["SELECTED"]) {
		$class[] = 'is-active';
	}
	if ($arItem["IS_PARENT"]) {
		$class[] = 'sidebar-nav__dropdown';
	}
	
	if (!empty($arItem['PARAMS']['target'])) {
		$attrs[] = ' target="'.$arItem['PARAMS']['target'].'"';
	}
			
	if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
		print str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
	}
?>
	
	<li<? !empty($class) and print ' class="'.implode(' ', $class).'"'; ?>><a href="<?= $arItem['LINK'] ?>"<?= implode('', $attrs) ?>><?= $arItem['TEXT'] ?></a>
	<? if ($arItem["IS_PARENT"]): ?><ul><? else: ?></li><? endif; ?>
<?
	$previousLevel = $arItem["DEPTH_LEVEL"];
	
endforeach; 

if ($previousLevel > 1) print str_repeat("</ul></li>", ($previousLevel-1) );
?>
    </ul>
</nav>
<? endif; ?>