
<div class="brand-entete">

	<?php if (isset($subscription) && $subscription) : ?>
	    <p>Vous êtes déjà abonné à cette marque.</p>
	    <?= $this->Form->postLink(
	        'Se désabonner',
	        ['controller' => 'Subscriptions', 'action' => 'unsubscribe', $b->id],
	        ['confirm' => 'Voulez-vous vraiment vous désabonner ?']
	    ) ?>
	<?php else : ?>
	    <p>Vous n'êtes pas encore abonné à cette marque.</p>
	    <?= $this->Form->postLink(
	        'S\'abonner',
	        ['controller' => 'Subscriptions', 'action' => 'subscribe', $b->id],
	        ['confirm' => 'Voulez-vous vraiment vous abonner à cette marque ?']
	    ) ?>
	<?php endif; ?>
</div>



<section class="list">
    <h1>Liste des Sneakers <?= $b->name ?></h1>
    <?php foreach ($b->sneakers as $s) : ?>
        <article class="sneaker">
            <figure>
                <?= $this->Html->image($s->image) ?>
            </figure>
            <p class="sneaker-name"><?= $this->Html->link($s->name, ['controller' => 'Sneakers', 'action' => 'details', $s->id]) ?></p>
        </article>
    <?php endforeach; ?>
</section>

<?php if ($this->request->getAttribute('identity')->level == 'admin') : ?>
	<div class="edn">
		
		<p><?= $this->Html->link('Modifier la marque', ['controller' => 'Brands', 'action' => 'edit', $b->id]) ?></p>
    	<p><?= $this->Html->link('Supprimer la marque', ['controller' => 'Brands', 'action' => 'delete', $b->id]) ?></p>

	</div>
<?php endif; ?>
