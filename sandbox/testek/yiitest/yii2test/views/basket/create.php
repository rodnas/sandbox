<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Basket */

$this->title = 'Add Kosarba';
$this->params['breadcrumbs'][] = ['label' => 'Kosar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="basket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
