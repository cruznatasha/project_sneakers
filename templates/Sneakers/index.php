<?php   		//templates/Sneakers/index.php ?>

<h1>Sneakers</h1>

<table>
	<thead>
		<tr>
			<th>Nom</th>
			<th>Marque</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach($allSneakers as $s) : ?>
			<tr>
				<td><?= $this->Html->link($s->name, ['controller' => 'Sneakers', 'action' => 'details', $s->id]) ?></td>

				<td><?= $s->brand->name ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
