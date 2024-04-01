
    <main class="container">
        <section class="list">

            <h1>Liste des Sneakers</h1>

            <?php foreach ($allSneakers as $s) : ?>
                <article class="sneaker">

                    <figure>
						<?= $this->Html->image($s->image) ?>
					</figure>

                    <p class="sneaker-name"><?= $this->Html->link($s->name, ['action' => 'details', $s->id]) ?></p>
                    	<?php if (in_array($s->id, $favoriteId)): ?>
	                        <?= $this->Form->postLink(
	                            '<i class="fa-solid fa-heart" style="color: #ff54f9;"></i>',
	                            ['controller' => 'Favorites', 'action' => 'remove', $s->id], 
	                           	['class' => 'button-heart', 'escape' => false]
	                        ) ?>
	                    <?php else: ?>
	                        <?= $this->Form->postLink(
	                            '<i class="fa-regular fa-heart" style="color: #ff54f9;"></i>',
	                            ['controller' => 'Favorites', 'action' => 'add', $s->id], 
	                            ['class' => 'button-heart', 'escape' => false]
	                        ) ?>
	                    <?php endif; ?> 
                </article>
            <?php endforeach; ?>

        </section>
    </main>

<?php if ($this->request->getAttribute('identity')->level == 'admin') : ?>
	<div class="edn">
		
		<p><?= $this->Html->link('Ajouter une paire', ['controller' => 'Sneakers', 'action' => 'new']) ?></p>

	</div>
<?php endif; ?>
