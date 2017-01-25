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
        <div class="col-md-8">
            <h1><?= $model->name ?> </h1>
            <p><?= $model->publish_date ?> </p>
            <p><?= $model->description ?></p>

        </div>
        <div class="col-md-4"  style="border-left: 1px solid #000000">

        </div>
    </div>
</div>