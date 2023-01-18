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

if (empty($arResult["VOTE"])):
	return false;
elseif (empty($arResult["QUESTIONS"])):
	return true;
endif;

$dateBegin = new \Bitrix\Main\Type\DateTime($arResult['VOTE']['TIMESTAMP_X']);
?>
        <div class="theme-dark tools-item tools-item--small <?= $arParams["THEME"] ?> tools-item--mh">
            <? foreach ($arResult["QUESTIONS"] as $arQuestion): ?>
            <div class="post-meta">
                <div class="post-meta__tag">Опрос</div>
                <div class="post-meta__txt"><?= Format::getFormatDate($dateBegin->getTimestamp()); ?></div>
            </div>
            <div class="tools-item__title"><?=$arQuestion["QUESTION"]?></div>
            <p><?= $arResult['VOTE']['DESCRIPTION']; ?></p>

            <form action="<?=POST_FORM_ACTION_URI?>" method="post" class="survey">
                <input type="hidden" name="vote" value="Y">
                <input type="hidden" name="PUBLIC_VOTE_ID" value="<?=$arResult["VOTE"]["ID"]?>">
                <input type="hidden" name="VOTE_ID" value="<?=$arResult["VOTE"]["ID"]?>">
                <?=bitrix_sessid_post()?>

                <?
                    foreach ($arQuestion["ANSWERS"] as $arAnswer):

                        switch ($arAnswer["FIELD_TYPE"]):
                            case 0://radio
                                $value=(isset($_REQUEST['vote_radio_'.$arAnswer["QUESTION_ID"]]) &&
                                    $_REQUEST['vote_radio_'.$arAnswer["QUESTION_ID"]] == $arAnswer["ID"]) ? 'checked="checked"' : '';
                                break;
                            case 1://checkbox
                                $value=(isset($_REQUEST['vote_checkbox_'.$arAnswer["QUESTION_ID"]]) &&
                                    array_search($arAnswer["ID"],$_REQUEST['vote_checkbox_'.$arAnswer["QUESTION_ID"]])!==false) ? 'checked="checked"' : '';
                                break;
                            case 2://select
                                $value=(isset($_REQUEST['vote_dropdown_'.$arAnswer["QUESTION_ID"]])) ? $_REQUEST['vote_dropdown_'.$arAnswer["QUESTION_ID"]] : false;
                                break;
                            case 3://multiselect
                                $value=(isset($_REQUEST['vote_multiselect_'.$arAnswer["QUESTION_ID"]])) ? $_REQUEST['vote_multiselect_'.$arAnswer["QUESTION_ID"]] : array();
                                break;
                            case 4://text field
                                $value = isset($_REQUEST['vote_field_'.$arAnswer["ID"]]) ? htmlspecialcharsbx($_REQUEST['vote_field_'.$arAnswer["ID"]]) : '';
                                break;
                            case 5://memo
                                $value = isset($_REQUEST['vote_memo_'.$arAnswer["ID"]]) ?  htmlspecialcharsbx($_REQUEST['vote_memo_'.$arAnswer["ID"]]) : '';
                                break;
                        endswitch;
                ?>

                <?
                switch ($arAnswer["FIELD_TYPE"]):
                    case 0://radio
                        ?>
                        <label for="vote_radio_<?=$arAnswer["QUESTION_ID"]?>_<?=$arAnswer["ID"]?>">
                            <input
                                <?=$value?>
                                type="radio"
                                name="vote_radio_<?=$arAnswer["QUESTION_ID"]?>"
                                id="vote_radio_<?=$arAnswer["QUESTION_ID"]?>_<?=$arAnswer["ID"]?>"
                                value="<?=$arAnswer["ID"]?>" <?=$arAnswer["~FIELD_PARAM"]?>
                            >
                            <span class="survey__option"><?=$arAnswer["MESSAGE"]?></span>
                        </label>
                        <?
                        break;

                        case 1://checkbox?>
                            <label>
                                <input
                                    <?=$value?>
                                    type="checkbox"
                                    name="vote_checkbox_<?=$arAnswer["QUESTION_ID"]?>[]"
                                    value="<?=$arAnswer["ID"]?>"
                                    id="vote_checkbox_<?=$arAnswer["QUESTION_ID"]?>_<?=$arAnswer["ID"]?>"
                                    <?=$arAnswer["~FIELD_PARAM"]?>
                                >
                                <span class="survey__option"><?=$arAnswer["MESSAGE"]?></span>
                            </label>
                        <?break?>
                    <?endswitch;?>
                <? endforeach; ?>

                <button class="btn btn--block btn--small btn--white mt-16">Голосовать</button>
            </form>
            <? endforeach; ?>
        </div>
