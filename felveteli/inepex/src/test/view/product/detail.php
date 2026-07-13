<!-- view/vehicle/detail.php -->
<?php $title = 'Termék adatok' ?>

<?php include 'view/inc/header.php'; ?>
<?php ob_start() ?>
<h1><?= $title ?></h1>

    <a href="../product" class="btn btn-primary btn-sm">Vissza</a>
    <dl>
        <dt>Id : </dt>
        <dd><?= $product['id'] ?></dd>
        <dt>Név : </dt>
        <dd><?= $product['name'] ?></dd>
        <dt>Rövid leírás : </dt>
        <dd><?= $product['short_description'] ?></dd>
        <dt>Ár : </dt>
        <dd><?= $product['price'] ?></dd>
    </dl>
<?php $puffer = ob_get_clean() ?>

<?php require 'view/inc/footer.php'; ?>
<?php include 'view/template.php' ?>