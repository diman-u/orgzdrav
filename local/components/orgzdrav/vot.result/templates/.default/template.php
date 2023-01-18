<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Orgzdrav\Helper\Format;

if (!empty($arResult["ERROR_MESSAGE"])): 
?>
<div class="vote-note-box vote-note-error">
	<div class="vote-note-box-text"><?=ShowError($arResult["ERROR_MESSAGE"])?></div>
</div>
<?
endif;

if (0 && !empty($arResult["OK_MESSAGE"])): 
?>
<div class="vote-note-box vote-note-note">
	<div class="vote-note-box-text"><?=ShowNote($arResult["OK_MESSAGE"])?></div>
</div>
<?
endif;

if (empty($arResult["VOTE"]) || empty($arResult["QUESTIONS"]) ):
	return true;
endif;

$dateBegin = new \Bitrix\Main\Type\DateTime($arResult['VOTE']['TIMESTAMP_X']);
?>

<? foreach ($arResult["QUESTIONS"] as $arQuestion): ?>
    <div class="theme-dark tools-item tools-item--small <?= $arParams["THEME"] ?> tools-item--mh">
        <div class="post-meta">
            <div class="post-meta__tag">опрос</div>
            <div class="post-meta__txt"><?= Format::getFormatDate($dateBegin->getTimestamp()); ?></div>
        </div>
        <div class="tools-item__title"><?= $arQuestion["QUESTION"] ?></div>

        <div class="survey">
            <?foreach ($arQuestion["ANSWERS"] as $arAnswer):

                $activeElement = false;

                switch ($arAnswer["FIELD_TYPE"]):
                    case 0://radio
                        $activeElement=(isset($_REQUEST['vote_radio_'.$arAnswer["QUESTION_ID"]]) &&
                            $_REQUEST['vote_radio_'.$arAnswer["QUESTION_ID"]] == $arAnswer["ID"]);
                        break;
                    case 1://checkbox
                        $activeElement=(isset($_REQUEST['vote_checkbox_'.$arAnswer["QUESTION_ID"]]) &&
                            array_search($arAnswer["ID"],$_REQUEST['vote_checkbox_'.$arAnswer["QUESTION_ID"]])!==false);
                        break;
                endswitch;
            ?>
            <div class="survey__result">
                <div class="survey__result-progress" style="width:<?=$arAnswer["BAR_PERCENT"]?>%;"></div>
                <div class="survey__result-info">
                    <div class="survey__result-label"><?= $arAnswer["MESSAGE"] ?></div>
                    <div class="survey__result-value">
                        <? if ($activeElement): ?>
                            <i class="icon icon--sm-check icon--white"></i>
                        <? endif; ?>
                        <?= $arAnswer["BAR_PERCENT"]; ?>%
                    </div>
                </div>
            </div>
            <?endforeach?>
        </div>

    </div>
<? endforeach; ?>
