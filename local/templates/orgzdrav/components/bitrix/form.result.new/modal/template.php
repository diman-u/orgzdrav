<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<? if ($arResult["isFormTitle"]) : ?>
    <div class="alert__title"><?=$arResult["FORM_TITLE"]?></div>
<? endif; ?>

<?php 
if ($arResult["isFormNote"] == "Y"): ?>
	<div class="message message--success">Спасибо. Данные успешно отправлены.</div>    
<?php else: ?>
	<? if ($arResult["isFormErrors"] == "Y") : ?>
		<div class="message message--danger"><?=$arResult["FORM_ERRORS_TEXT"];?></div>
	<? endif; ?>

	<?=$arResult["FORM_HEADER"]?>
	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
			print $arQuestion["HTML_CODE"];
		}
	}
	?>
	
	<? 
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) : 
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
			print $arQuestion["HTML_CODE"];
			continue;
		}
	?>
		<label class="label">
			<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
		</label>
        <div class="control">
            <?=$arQuestion["HTML_CODE"]?>
			<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<div class="help help--danger"><?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?></div>
			<?endif;?>
        </div>
	<? endforeach; ?>
	
	<input class="btn btn--big btn--block btn--bright mt-24" type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
	
	<p class="alert__help">
		<?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
	</p>
    <?=$arResult["FORM_FOOTER"]?>
<?php endif; ?>