<?php
CJSCore::Init(['jquery', 'ajax', 'json', 'session']);
?>

<script>
    $(document).ready(function () {
        BX.namespace('Ylab.Components.SignedParameters');
        BX.Ylab.Components.SignedParameters["<?=$this->getComponent()->getEditAreaId("")?>"] = "<?=$this->getComponent()->getSignedParameters()?>";
    });
</script>

<div class="" data-element="<?= $arParams['ELEMENT_ID'] . "," . $arParams['ENTITY_ID'] ?>">
    <div class="post-likes vote_action">
        <button type="button"
            class="like post-likes__btn post-likes__btn--thumbs-up-active js-like-action <?= ($arResult['STAT']['IS_VOTED'] == 'LIKE' ? "is-active" : "") ?>"
            data-eid="<?= $this->getComponent()->getEditAreaId("") ?>"
        >
            <span class="counter js-like-counter">
                <?= (!empty($arResult['STAT']['COUNT_LIKE']) ? $arResult['STAT']['COUNT_LIKE'] : 0) ?>
            </span>
        </button>
        <button type="button"
            class="post-likes__btn post-likes__btn--thumbs-down dislike js-dislike-action <?= ($arResult['STAT']['IS_VOTED'] == 'DISLIKE' ? "is-active" : "") ?>"
            data-eid="<?= $this->getComponent()->getEditAreaId("") ?>"
        >
            <span class="counter js-dislike-counter">
                <?= (!empty($arResult['STAT']['COUNT_DISLIKE']) ? $arResult['STAT']['COUNT_DISLIKE'] : 0) ?>
            </span>
        </button>
    </div>
</div>
