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
$previousLevel = 0;
?>

<? if (!empty($arResult)): ?>

    <?php foreach($arResult as $item):
        if ($previousLevel && $item["DEPTH_LEVEL"] < $previousLevel) {
            print str_repeat("</ul>", ($previousLevel - $item["DEPTH_LEVEL"]));
        }
    ?>


            <? if($item['DEPTH_LEVEL'] == 1 && $item['IS_PARENT']):?>
                <p class="h5"><?= $item['TEXT']?></p>
                <ul class="menu">
            <? elseif($item['DEPTH_LEVEL'] == 2): ?>
                <li class="menu__item">
                    <a class="menu__link" href="<?= $item['LINK']?>"><?= $item['TEXT']?></a>
                </li>
            <? endif; ?>

        <?php
        $previousLevel = $item["DEPTH_LEVEL"];
        endforeach;

        if ($previousLevel > 1) print str_repeat("</ul>", ($previousLevel-1) );
        ?>

<? endif; ?>

<?php //dump($arResult) ?>
