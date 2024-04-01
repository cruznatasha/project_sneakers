<?php   	//templates/Sneakers/edit.php   ?>

<h1>Modifier une paire</h1>
<?= $this->Form->create($s, ['url' => ['controller' => 'Sneakers', 'action' => 'edit', $s->id]]); ?>

	<?= $this->Form->control('name', ['label' => 'Nom de la paire']); ?>
	<?= $this->Form->control('color', ['label' => 'Couleur']); ?>
	<?= $this->Form->control('releasedate', ['label' => 'Date de sortie']); ?>
	<?= $this->Form->control('brand_id', ['options' => $brands, 'label' => 'Marque']); ?>
	<?= $this->Form->control('image', ['label' => 'Nom du fichier image']); ?>
	<?= $this->Form->button('Modifier'); ?>

<?= $this->Form->end(); ?> 