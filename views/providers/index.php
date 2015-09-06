<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RegruProvidersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Regru Providers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regru-providers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Regru Providers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date_create',
            'name',
            'type',
            'count_ns',
            // 'type',
            // 'status',
            // 'count_ns',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
