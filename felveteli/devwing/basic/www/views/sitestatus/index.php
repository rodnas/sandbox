<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Site Status';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h2><?= Html::encode('db') ?></h2>
	<pre><?php print_r($siteStatus->db); ?></pre>	

    <h2><?= Html::encode('Request') ?></h2>
	<pre><?php print_r($siteStatus->request); ?></pre>	

    <h2><?= Html::encode('id') ?></h2>
	<pre><?php print_r($siteStatus->id); ?>	</pre>	

    <h2><?= Html::encode('basePath') ?></h2>
	<pre><?php print_r($siteStatus->basePath); ?></pre>	

    <h2><?= Html::encode('bootstrap') ?></h2>
	<pre><?php print_r($siteStatus->bootstrap); ?></pre>	

    <h2><?= Html::encode('user') ?></h2>
	<pre><?php print_r($siteStatus->user); ?></pre>	

    <h2><?= Html::encode('errorHandler') ?></h2>
	<pre><?php print_r($siteStatus->errorHandler); ?></pre>	

    <h2><?= Html::encode('mailer') ?></h2>
	<pre><?php print_r($siteStatus->mailer); ?></pre>	

    <!-- h2><?= Html::encode('log') ?></h2>
	<pre><?php print_r($siteStatus->log); ?></pre -->	

</div>
