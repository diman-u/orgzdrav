
<div class="voting-form-box">
    <form action="<?=POST_FORM_ACTION_URI?>" method="post" class="vote-form">
        <input type="hidden" name="vote" value="Y">
        <input type="hidden" name="PUBLIC_VOTE_ID" value="<?=$arResult["VOTE"]["ID"]?>">
        <input type="hidden" name="VOTE_ID" value="<?=$arResult["VOTE"]["ID"]?>">
        <?=bitrix_sessid_post()?>

        <span class="vote-answer-item vote-answer-item-radio">
            <input type="radio" <?=$value?> name="vote_radio_<?=$arAnswer["QUESTION_ID"]?>" <?
            ?>id="vote_radio_<?=$arAnswer["QUESTION_ID"]?>_<?=$arAnswer["ID"]?>" <?
                   ?>value="<?=$arAnswer["ID"]?>" <?=$arAnswer["~FIELD_PARAM"]?> />
                <label for="vote_radio_<?=$arAnswer["QUESTION_ID"]?>_<?=$arAnswer["ID"]?>"><?=$arAnswer["MESSAGE"]?></label>
        </span>
    </form>
</div>