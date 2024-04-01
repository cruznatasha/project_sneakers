<?php   	//templates/Brands/edit.php   ?>

<h1>Modifier une marque</h1>
<?= $this->Form->create($b, ['url' => ['controller' => 'Brands', 'action' => 'edit', $b->id]]); ?>

	<?= $this->Form->control('name', ['label' => 'Nom de la paire']); ?>
	<?= $this->Form->button('Modifier'); ?>

<?= $this->Form->end(); ?> 