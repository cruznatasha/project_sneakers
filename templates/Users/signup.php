<?php //templates/Users/signup.php ?>

<h1>s'inscrire</h1>

<?= $this->Form->create($user) ?>

	<?= $this->Form->control('pseudo') ?>
	<?= $this->Form->control('password') ?>
	<?= $this->Form->submit('valider') ?>

<?= $this->Form->end() ?>

