<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Basket */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kosar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="basket-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modositas', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Torles', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'price',
            'on_sale',
        ],
    ]) ?>

</div>
