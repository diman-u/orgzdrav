<article class="post content post--education">
	<h1><?= $arResult['NAME'] ?></h1>
    <div class="post-meta">
        <div class="post-meta__tag">Книга</div>
        <div class="post-meta__txt"><?= $arResult['DATE_BEGIN'] ?></div>
        <div class="post-meta__cnt"></div>
<!--        <a class="post-meta__bookmark" href=""></a>-->
    </div>

	<div class="grid-2col">
		<div class="grid-2col__column post">
            <?= $arResult['DETAIL_TEXT'] ?>
            <footer>
                <div>
                    <strong><?= $arResult['PROPERTIES']['AUTHOR']['NAME'] ?></strong>
                    <?= $arResult['PROPERTIES']['AUTHOR']['VALUE'] ?>
                </div>
            </footer>
            <div>
                <a href="<?= $arResult['PROPERTIES']['LINK']['VALUE'] ?>" target="_blank">
                    <button type="button" class="btn">Купить</button>
                </a>
            </div>
		</div>
        <div class="grid-2col__column">
            <div class="js-sticky-block">
                <div class="card">
                    <img src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="">
                    <table style="margin-top: 20px">
                        <tr>
                            <td><b><?= $arResult['PROPERTIES']['ARTIKUL']['NAME'] ?></b></td>
                            <td><?= $arResult['PROPERTIES']['ARTIKUL']['VALUE'] ?></td>
                        </tr>
                        <tr>
                            <td><b><?= $arResult['PROPERTIES']['YEAR']['NAME'] ?></b></td>
                            <td><?= $arResult['PROPERTIES']['YEAR']['VALUE'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
	</div>
</article>