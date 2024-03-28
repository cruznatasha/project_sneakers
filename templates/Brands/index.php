<?php   		//templates/Brands/index.php ?>

<h1>Marques</h1>

<table>
	<thead>
		<tr>
			<th>Marque</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach($allBrands as $b) : ?>
			<tr>
				<td><?= $this->Html->link($b->name, ['controller' => 'Brands', 'action' => 'details', $b->id]) ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
