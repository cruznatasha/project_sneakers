<?php   		//templates/Brands/index.php ?>

<?php //var_dump($this->request->getAttribute('identity')->level)?>

<section class="list">

	<h1>Tous les articles</h1>

    <?php foreach ($allArticles as $a) : ?>
        <article class="article">

            <figure>
				<?= $this->Html->image($a->img) ?>
			</figure>

            <p class="article-title"><?= $this->Html->link($a->title, ['action' => 'details', $a->id]) ?></p>
            
        </article>
    <?php endforeach; ?>


</section>

<?php if ($this->request->getAttribute('identity')->level == 'admin') : ?>
    <div class="edn">
        
        <p><?= $this->Html->link('Ajouter un article', ['controller' => 'Articles', 'action' => 'new']) ?></p>

    </div>
<?php endif; ?>
