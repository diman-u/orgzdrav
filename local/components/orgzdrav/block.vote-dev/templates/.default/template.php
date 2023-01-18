<div>
    <? if ($arResult['VOTE']): ?>
        <p>
            <?= $arResult['VOTE']['TITLE']; ?>
        </p>
        <p>
            <a href="<?= $arResult['VOTE']['LINK']; ?>">
                <?= $arResult['VOTE']['TITLE']; ?>
            </a>
        </p>
    <? endif; ?>
</div>