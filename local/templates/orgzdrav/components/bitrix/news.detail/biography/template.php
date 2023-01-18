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

<? if (!empty($arResult['PREVIEW_TEXT'])) : ?>
<ul class="tabs-nav" data-target="#bio">
	<li class="tabs-nav__item tabs-nav__item--active"><a>Русская версия</a></li>
	<li class="tabs-nav__item"><a>English</a></li>
</ul>
<? endif; ?>
<article class="post content">
	<div id="bio" class="tab-content">
		<div class="tab-content__pane tab-content__pane--active">
			<? if (!empty($arResult['DETAIL_PICTURE']['SRC'])) : ?>
				<img class="post__float-img" src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?= $arResult['NAME'] ?>" />
			<? endif; ?>
			<?= $arResult['~DETAIL_TEXT'] ?>
		</div>
		
		<? if (!empty($arResult['PREVIEW_TEXT'])) : ?>
			<div class="tab-content__pane">
				<? if (!empty($arResult['DETAIL_PICTURE']['SRC'])) : ?>
					<img class="post__float-img" src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?= $arResult['NAME'] ?>" />
				<? endif; ?>
				<?= $arResult['~PREVIEW_TEXT'] ?>
			</div>
		<? endif; ?>
	</div>
</article>