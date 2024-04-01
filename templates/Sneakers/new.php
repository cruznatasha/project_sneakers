<?php   	//templates/Brands/new.php   ?>

<h1>Ajouter une paire</h1>

<?= $this->Form->create($new); ?>

	<?= $this->Form->control('name', ['label' => 'Nom de la paire']); ?>
	<?= $this->Form->control('brand_id', ['options' => $brands, 'label' => 'Marque']); ?>
	<?= $this->Form->control('color', ['label' => 'Couleur']); ?>
	<?= $this->Form->control('releasedate', ['label' => 'Date de sortie']); ?>
	<?= $this->Form->control('image', ['label' => 'Nom du fichier image']); ?>
	<?= $this->Form->button('Ajouter'); ?>

<?= $this->Form->end(); ?>