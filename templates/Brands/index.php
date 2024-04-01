<?php   		//templates/Brands/index.php ?>

<?php //var_dump($this->request->getAttribute('identity')->level)?>

<section class="list">

	<h1>Toutes les marques</h1>

    <?php foreach ($allBrands as $b) : ?>
    	<div class="brand">
				<p class="brand-name"><?= $this->Html->link($b->name, ['controller' => 'Brands', 'action' => 'details', $b->id]) ?></p>
		</div>
	<?php endforeach; ?>


</section>

<?php if ($this->request->getAttribute('identity')->level == 'admin') : ?>
	<div class="edn">
		
		<p><?= $this->Html->link('Ajouter une marque', ['controller' => 'Brands', 'action' => 'new']) ?></p>

	</div>
<?php endif; ?>