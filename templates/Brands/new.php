<?php   	//templates/Brands/new.php   ?>

<h1>Ajouter une marque</h1>
<?= $this->Form->create($new); ?>

	<?= $this->Form->control('name', ['label' => 'Nom de la marque']); ?>
	<?= $this->Form->button('Ajouter'); ?>

<?= $this->Form->end(); ?>