<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
	<? foreach ($arResult['ITEMS'] as $item): ?>
		<div class="col">
			<a class="card shadow-sm" href="<?= $item['detail_url'] ?>">
				<img alt="" src="https://via.placeholder.com/300x200" class="img-fluid mb-2">
				
				<div class="card-body">
					<h5 class="card-title"><?= $item['dnt'] ?></h5>
					<p class="card-text"><?= $item['dsc.dfn'] ?></p>
				</div>
			</a>
        </div>
	<? endforeach; ?>   
</div>