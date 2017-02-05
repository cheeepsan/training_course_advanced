<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\detail\DetailView;
use yii\helpers\Url;
$this->title = 'User view';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
<div class="row">
    <div class="col-md-8">
        <h1><?= $model->name . ' ' . $model->surname ?></h1>
        <?php $form = ActiveForm::begin([
            'id' => 'add-course-form',
            'options' => ['class' => '', 'enctype' => 'multipart/form-data'],
            'fieldConfig' => [
                //'template' => "{label}\n<div class=\"col-lg-7\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                //'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]);

        ?>

        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'surname')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'sex')->radioList([0 => 'Male', 1 => 'Female']) ?>
        <?= $form->field($model, 'date_of_birth')->widget(yii\jui\DatePicker::classname(), ['dateFormat' => 'yyyy-MM-dd']) ?>
        <?= $form->field($model, 'phone')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'instagram')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'facebook')->textInput(['autofocus' => true]) ?>
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Create task', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
    </div>
</div>
</div>

</div>


