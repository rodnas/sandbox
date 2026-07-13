<?php
$title = 'Termék'; 
include 'view/inc/header.php';
ob_start();
?>
	<br>
    <center><h1><?= $title ?></h1></center>

	<br>
	<div class="table-responsive"> 
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Név</th>
            <th>Rövid leírás</th>
            <th>Ár</th>
            <th>Rögzítve</th>
        </tr>
        <?php 
foreach ($product as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['short_description'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['when_add'] ?></td>
            <td><a href="product/detail?id=<?= $row['id'] ?>" class="btn btn-success btn-xs"> Adatok</a></td>
            <td><a href="product/edit?id=<?= $row['id'] ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit"></span> Módosítás</a></td>
            <td><a href="product/delete?id=<?= $row['id']?>" onclick="return confirm('Anda yakin akan menghapus data ini?')" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-trash"></span> Törlés</a></td>
        </tr>
        <?php endforeach ?>
    </table>
	</div>
    <br>
    <a href="product/create" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Új</a>
<?php $puffer = ob_get_clean() ?>
<?php require 'view/inc/footer.php'; ?>
<?php include 'view/template.php' ?>

<?php
