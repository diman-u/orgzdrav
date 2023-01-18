
<div id="orgzdrav-bookmarks">
    <div class="row">
    <? foreach($arResult['BOOKMARKS'] as $bookmarks): ?>
            <div class="col-md-4">
                <div>
                    <?= $bookmarks['NAME'] ?>
                    <button
                            type="button"
                            class="btn"
                            @click.prevent="add(<?= $bookmarks['ID'] ?>)"
                    >Добавить
                    </button>

                    <button
                            type="button"
                            class="btn"
                            @click.prevent="delete()"
                    >Удалить
                    </button>
                </div>
                <div>
                    <? $bookmarks['PREVIEW_TEXT'] ?>
                </div>
            </div>
    <? endforeach; ?>
    </div>
</div>