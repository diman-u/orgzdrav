<?if (!empty($arResult['VOTE'])) : ?>
<div class="tools-box tools-box--theme-green tools-box--theme-bg">
	<div class="tools-box__icon">
		<span class="icon icon--white-50 icon--lg-user-sing-up"></span>
	</div>
	<div class="tools-box__title">Пройти опрос</div>
	<a class="tools-box__link u-link-holder" href="<?= $arResult['VOTE']['LINK']; ?>"><?= $arResult['VOTE']['TITLE']; ?></a>
</div>
<? endif; ?>