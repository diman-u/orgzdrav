<article class="post content post--education" data-type="iblock" data-id="<?= $arResult['ID'] ?>">
	<h1><?= $arResult['NAME'] ?></h1>
	<div class="post-meta">
		<div class="post-meta__tag">Обучение</div>
		<div class="post-meta__txt"><?= $arResult['CURRENT_DATE'] ?></div>
		<div class="post-meta__cnt"></div>
		<?/*<a class="post-meta__bookmark" href=""></a>*/?>
	</div>

	<div class="grid-2col">
		<div class="grid-2col__column">
			<? if (!empty($arResult['DETAIL_PICTURE']['SRC'])) : ?>
				<figure>
					<img src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?= htmlspecialchars($arResult['NAME']) ?>" />
				</figure>
			<? endif; ?>
		
			<?= $arResult['DETAIL_TEXT'] ?>
			
			<? if (!empty($arResult['SPEAKERS'])) : ?>
            <h3>Лекторы</h3>
            <div class="js-hidden">
                <?php foreach ($arResult['SPEAKERS'] as $item): ?>
                    <div class="person">
                        <div class="person__media">
                            <img alt="" src="<?= $item['IMAGE']?>">
                        </div>
                        <div class="person__info">
                            <div class="person__title"><?= $item['NAME']?></div>
                            <div class="person__subtitle"><?= $item['POST']?></div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
			<? endif; ?>
			
			<? if (!empty($arResult['DISPLAY_PROPERTIES']['gallery']['FILE_VALUE'])) : ?>
			<div class="swiper content-swiper mt-28 mb-28">
				<div class="swiper-wrapper">
					<?php foreach ($arResult['DISPLAY_PROPERTIES']['gallery']['FILE_VALUE'] as $item): ?>
						<div class="swiper-slide">
							<img src="<?= $item['SRC'] ?>" alt="" />
						</div>
					<?php endforeach ?>
				</div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
			<? endif; ?>
			
			<? if (!empty($arResult['DISPLAY_PROPERTIES']['link']['VALUE'])) : ?>
				<footer>
					<div>Перейти на сайт курса: <a href="<?= $arResult['DISPLAY_PROPERTIES']['link']['VALUE'] ?>" target="_blank"><?
						print parse_url($arResult['DISPLAY_PROPERTIES']['link']['VALUE'], PHP_URL_HOST);
					?></a></div>
				</footer>
			<? endif; ?>
		</div>
		<div class="grid-2col__column">
		
			<? if (!empty($arResult['PRICES'])) : ?>
				<div class="js-sticky-block">
					<div class="card">
						<h4>Записаться на курс</h4>
						<form>
							<? foreach ($arResult['PRICES'] as $i => $option) : ?>
								<div class="price-option">
									<div class="checkbox">
										<input type="radio" name="option" value="<?= $option['id'] ?>" id="option_<?= $option['id'] ?>" <? 0 === $i and print ' checked' ?> />
										<label for="option_<?= $option['id'] ?>"></label>
									</div>
									<div class="price-option__info">
										<?= $option['title'] ?>
										<? if (!empty($option['subtitle'])) : ?>
											<small><?= $option['subtitle'] ?></small>
										<? endif; ?>
									</div>
									<div class="price-option__sum"><?= $option['sum'] ?></div>
								</div>
							<? endforeach; ?>
							<? if (!empty($arResult['DISPLAY_PROPERTIES']['link']['VALUE'])) : ?>
								<a class="btn btn--bright btn--block btn--big" href="<?= $arResult['DISPLAY_PROPERTIES']['link']['VALUE'] ?>" target="_blank">Записаться</a>
							<? endif; ?>
						</form>
					</div>
				</div>
			<? else : ?>
				<div id="news-sidebar"></div>
				<div id="news-small-1"></div>
			<? endif; ?>
			
		</div>
	</div>
</article>