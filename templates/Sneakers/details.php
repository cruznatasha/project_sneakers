<?php    		//templates/Sneakers/details.php 

?>

<h1>
	<?= $s->name ?>
</h1>

<table>
	<thead>
		<tr>
			<th>Nom : </th>
			<td><?= $s->name ?></td>
		</tr>

		<figure>
			<?= $this->Html->image($s->image) ?>
		</figure>

		<tr>
			<th>Marque : </th>
			<td><?= $s->brand->name ?></td>
		</tr>
			
		<tr>
			<th>Date de sortie : </th>
			<td><?= $s->releasedate ?></td>
		</tr>


	</thead>
</table>