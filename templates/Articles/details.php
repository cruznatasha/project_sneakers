<?php    		//templates/Articles/details.php 

?>

<h1>
	<?= $a->title ?>
</h1>

<table>
	<thead>

		<figure>
			<img src="../webroot/img/<?= $a->image ?>">
		</figure>

		<tr>
			<td><?= $a->content ?></td>
		</tr>

		<tr>
			<th>date : <?= $a->date ?></th>
		</tr>
		
	</thead>
</table>