<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Basket;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BasketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kosar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="basket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Kosar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
	'showFooter' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
	    [
        	 'attribute' => 'price',
                 'footerOptions' => ['style' => 'text-align: right !important;'],
                 'contentOptions' => ['class' => 'text-right'],
	         'footer' => Basket::getTotal($dataProvider->models, 'price'),       
	    ],
            'on_sale',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
