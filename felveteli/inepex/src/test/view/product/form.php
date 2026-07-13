<!-- view/vehicle/form.php -->
<?php
$request = preg_replace("|/*(.+?)/*$|", "\\1", $_SERVER['PATH_INFO']);
$uri = explode('/', $request);

// Set form action
if ($uri[1] === 'edit') {
    $title = 'Módosítás Termék';
    $form_action = "edit?id=" . $_GET['id'];
} else {
    $title = 'Új Termék';
    $form_action = "create";
}

$valName = isset($product['name']) ? $product['name'] : '';
$valShort_description = isset($product['short_description']) ? $product['short_description'] : '';
$valPrice = isset($product['price']) ? $product['price'] : '';
$valId = isset($product['id']) ? $product['id'] : '';

?>

<?php include 'view/inc/header.php'; ?>
<?php ob_start() ?>
    <h1><?= $title ?></h1>

    <a href="../product" class="btn btn-primary btn-sm">Vissza</a>
    <form action="<?= $form_action ?>" method="post">
        <?php if ($valId): ?>
            <input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>">
        <?php endif ?>

        <div class="form-group">
            <label for="name">Név</label>
            <input name="name" type="text" value="<?= $valName ?>" class="form-control" id="name" placeholder="Név">
        </div>

        <div class="form-group">
            <label for="short_description">Rövid leírás</label>
            <input name="short_description" type="text" value="<?= $valShort_description ?>" class="form-control" id="short_description" placeholder="Rövid leírás">
        </div>

        <div class="form-group">
            <label for="price">Ár</label>
            <input name="price" type="text" value="<?= $valPrice ?>" class="form-control" id="price" placeholder="Ár">
        </div>    
		

        <button class="btn btn-primary" type="submit">Mentés</button>
    </form>
<?php $puffer = ob_get_clean() ?>

<?php require 'view/inc/footer.php'; ?>
<?php include 'view/template.php' ?>