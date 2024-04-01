<?php    		//templates/Articles/details.php 

?>

<div class="container-articles-details">
	<div>
		<h1>
			<?= $a->title ?>
		</h1>
		<p>Date de publication : <?= $a->date ?></p>
	</div>

	<figure>
		<?= $this->Html->image($a->img) ?>
	</figure>

</div>

<p class="content">
	<?= $a->content ?>
</p>


<?php if ($this->request->getAttribute('identity')->level == 'admin') : ?>
	<div class="edn">
		
		<p><?= $this->Html->link('Modifier l\'article', ['controller' => 'Articles', 'action' => 'edit', $a->id]) ?></p>
    	<p><?= $this->Html->link('Supprimer l\'article', ['controller' => 'Articles', 'action' => 'delete', $a->id]) ?></p>

	</div>
<?php endif; ?>