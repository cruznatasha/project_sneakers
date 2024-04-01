<?php   	//templates/Articles/edit.php   ?>

<h1>Modifier un article</h1>
<?= $this->Form->create($a, ['url' => ['controller' => 'Articles', 'action' => 'edit', $a->id]]); ?>

<?php $user = $this->request->getAttribute('identity')->id ;
	//var_dump($user);
 ?>

	<?= $this->Form->control('title', ['label' => 'Titre']); ?>
	<?= $this->Form->control('img', ['label' => 'Nom du fichier image']); ?>
	<?= $this->Form->control('content', ['label' => 'Contenu']); ?>
	<?= $this->Form->control('date', ['label' => 'Date']); ?>
	<?= $this->Form->hidden('user_id', ['value' => $user]); ?>
	<?= $this->Form->button('Modifier'); ?>

<?= $this->Form->end(); ?> 
