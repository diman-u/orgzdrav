<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);
?>
<nav class="pagination mt-32" role="navigation" aria-label="Навигация">
	<?if ($arResult["CURRENT_PAGE"] > 1):?>
		<a class="pagination__prev" href="<?=htmlspecialcharsbx($component->replaceUrlTemplate($arResult["CURRENT_PAGE"]-1))?>">Назад</a>
	<? else: ?>
		<span class="pagination__prev pagination__prev--disabled">Назад</span>
	<?endif?>
	
	<?if($arResult["CURRENT_PAGE"] < $arResult["PAGE_COUNT"]):?>
		<a class="pagination__next" href="<?=htmlspecialcharsbx($component->replaceUrlTemplate($arResult["CURRENT_PAGE"]+1))?>">Вперед</a>
	<?else:?>
		<span class="pagination__next pagination__next--disabled">Вперед</span>
	<?endif?>
	
	
	<ul class="pagination__list">
	<?
	$page = $arResult["START_PAGE"];
	while($page <= $arResult["END_PAGE"]):
	?>
		<?if ($page == $arResult["CURRENT_PAGE"]):?>
			<li><span class="pagination__link pagination__link--current"><?=$page?></span></li>
		<?else:?>
			<li><a class="pagination__link" href="<?=htmlspecialcharsbx($component->replaceUrlTemplate($page))?>"><?=$page?></a></li>
		<?endif?>
		<?$page++?>
	<?endwhile?>
	</ul>
</nav>