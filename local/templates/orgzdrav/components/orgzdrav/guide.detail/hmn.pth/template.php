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

$dnt = $arResult['dnt'];
unset($arResult['dnt']);

//echo '<pre>',var_export($arResult),'</pre>';

$entityPrintValue = function($field)
{
	if (!empty($field['value'])) {
		print '<div id="'.$field['id'].'-value" class="mt-2 mb-4 js-section">'.$field['value'].'</div>';
	}
};

$entityPrintFields = function($fields, $header = 4) use (&$entityPrintFields)
{
	foreach ($fields as $fieldId => $field) {
		if (!empty($field['value'])) {
			print '<div id="'.$fieldId.'" class="mb-4 js-section">';
			
			print sprintf('<h%1$d>%2$s</h%1$d>', $header, $field['head']);
			
			if ('mselect' == $field['type'] && is_array($field['value'])) {
				print '<ul><li>'.implode('</li><li>', $field['value']).'</li></ul>';
			} else {
				print $field['value'];
			}
			
			print '</div>';
		}
		
		if (!empty($field['fields'])) {
			$entityPrintFields($field['fields'], $header + 1);
		}
	}
};

$sectionHasContent = function($fields) use (&$sectionHasContent)
{
	$hasContent = false;
	
	foreach ($fields as $field) {
		$hasContent |= !empty($field['value']);
		
		if (!empty($field['fields'])) {
			$hasContent |= $sectionHasContent($field['fields']);
		}
	}
	
	return $hasContent;
};

$sectionIsActive = function($field, $anchor) use (&$sectionIsActive)
{
	$isActive = $field['id'] === $anchor || in_array($field['id'], explode('.', $anchor));
	
	if ($isActive) {
		return true;
	}
	
	foreach ($field['fields'] as $subField) {
		$isActive |= $subField['id'] === $anchor || in_array($subField['id'], explode('.', $anchor));
		
		if (!empty($subField['fields'])) {
			$isActive |= $sectionIsActive($subField['fields'], $anchor);
		}
	}
	
	return $isActive;
};

$count = 0;
?>
<h1><?= $dnt['value'] ?></h1>
<div class="js-guide-entity-workspace mt-5">
<div class="accordion" id="hmn.pth">
	<? 
	foreach ($arResult as $fieldId => $field) : 
		if (empty($field['value']) && !$sectionHasContent($field['fields'])) {
			continue;
		}
		
		$isActive = empty($arParams['ANCHOR']) ? !$count : $sectionIsActive($field, $arParams['ANCHOR']);
	?>
	<div class="accordion-item">
		<h2 class="accordion-header">
			<button class="accordion-button<? !$isActive and print ' collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $fieldId ?>">
				<?= $field['head'] ?>
			</button>
		</h2>
		<div id="<?= $fieldId ?>" class="accordion-collapse collapse<? $isActive and print ' show' ?>">
			<div class="accordion-body">
				<? $entityPrintValue($field); ?>
				<? $entityPrintFields($field['fields']) ?>
			</div>
		</div>
	</div>
	<? 
		$count ++;
	endforeach; ?>
</div>
</div>