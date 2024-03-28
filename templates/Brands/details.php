<?php   		//templates/Brands/details.php ?>

<h1>Sneakers de la marque : <?php $b->name ?></h1>

<table>
	<thead>
		<tr>
			<th>Paires de la marque</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach($b->sneakers as $s) : ?>
			<tr>
				<td><?= $this->Html->link($s->name, ['controller' => 'Sneakers', 'action' => 'details', $s->id]) ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>