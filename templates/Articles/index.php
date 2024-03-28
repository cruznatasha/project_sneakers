<?php   		//templates/Articles/index.php ?>

<h1>Nos actualités</h1>

<table>
	<thead>
		<tr>
			<th>Titre</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach($allArticles as $a) : ?>
			<tr>
				<td><?= $this->Html->link($a->title, ['controller' => 'Articles', 'action' => 'details', $a->id]) ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php var_dump($this->request->getAttribute('identity')->level)?>

<?php if($this->request->getAttribute('identity')->level == 'admin') : ?>

<p><?= $this->Html->link('Ajouter un article', ['controller' => 'Articles', 'action' => 'new']) ?></p>
	
<?php endif; ?>

