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
    <ul class="menu">
    <? foreach ($arResult as $item):?>
        <li class="menu__item"><a class="menu__link" href="<?= $item['LINK'] ?>"><?= $item['TEXT'] ?></a></li>
    <? endforeach; ?>
    </ul>
<? endif; ?>