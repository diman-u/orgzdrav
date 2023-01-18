<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<div class="component" id="calc">
<?
	if (true === $arResult['USE_LOGIC']) :
		echo '<div class="u-auth-only">';
		require_once $arResult['DIR_LOGIC'].'/template.php';
		echo '</div>';
	else :
?>
	<p>Калькулятор находится в разработке.</p>
<? endif; ?>
<div>