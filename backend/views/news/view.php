<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\detail\DetailView;
use yii\helpers\Url;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1><?= $model->name ?> </h1>
            <p><?= $model->description ?></p>
        </div>
    </div>
</div>