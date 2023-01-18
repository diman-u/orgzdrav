
<div class="offcanvas__panel" data-panel="filter">
    <button type="button" class="btn-close js-panel-toggle" data-panel="filter" aria-hidden="true">
        <span class="icon icon--md-x"></span>
    </button>
    <div id="orgzdrav-filter-show"></div>
</div>
<script>
    window.orgzdrav_newsFilter = <?= json_encode($arResult['NEWS_CATEGORY'])?>;
    window.orgzdrav_checkCategories = <?= json_encode($arResult['CHECK_CATEGORIES'])?>;
</script>