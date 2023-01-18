<div id="doc-reader">
	<? foreach ($arParams['DOC_ID'] as $id => $title) : ?>
	<article class="post js-doc" data-id="<?= $id ?>">
		<div class="post-info">
			<a class="post-info__title js-doc-title" href="#"><?= $title ?></a>
		</div>
	</article>
	<? endforeach; ?>
</div>