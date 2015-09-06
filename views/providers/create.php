<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RegruProviders */

$this->title = 'Create Regru Providers';
$this->params['breadcrumbs'][] = ['label' => 'Regru Providers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regru-providers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
