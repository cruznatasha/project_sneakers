<?php   	//templates/Articles/new.php   ?>

<h1>Ajouter un nouvel article</h1>
<?= $this->Form->create($new); ?>

	<?= $this->Form->control('title', ['label' => 'Titre de l\'article']); ?>
	<?= $this->Form->control('img', ['label' => 'Nom du fichier image']); ?>
	<?= $this->Form->control('content', ['label' => 'Contenu']); ?>
	<?= $this->Form->button('Ajouter'); ?>

<?= $this->Form->end(); ?>