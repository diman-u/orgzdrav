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
<nav class="section-menu">
    <ul>
        <? foreach ($arResult as $item):?>
            <li id="<?= $item['ID'] ?>" class="<?= $item['SELECTED'] ? 'section-menu__active' : '' ?>">
                <a href="<?= $item['LINK'] ?>"><?= $item['TEXT'] ?></a>
            </li>
        <? endforeach; ?>
    </ul>
</nav>