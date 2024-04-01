<div class="article-sneaker">
    <h1 class="details-name"><?= $s->name ?></h1>

    <div class="container-sneakers-details">
        <div class="details">
            <div class="details-image">
                <figure>
                    <?= $this->Html->image($s->image) ?>
                </figure>
            </div>
            <div class="details-info">
                <p><strong>Nom :</strong> <?= $s->name ?></p>
                <p><strong>Marque :</strong> <?= $s->brand->name ?></p>
                <p><strong>Date de sortie :</strong> <?= $s->releasedate ?></p>
            </div>
        </div>
    </div>

<?php if ($this->request->getAttribute('identity')->level == 'admin') : ?>
    <div class="edn">
        
        <p><?= $this->Html->link('Modifier la paire', ['controller' => 'Sneakers', 'action' => 'edit', $s->id]) ?></p>
        <p><?= $this->Html->link('Supprimer la paire', ['controller' => 'Sneakers', 'action' => 'delete', $s->id]) ?></p>

    </div>
<?php endif; ?>
</div>
