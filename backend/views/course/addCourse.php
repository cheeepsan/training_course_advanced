<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\ckeditor\CKEditor;

$this->title = 'New course';
  if(Yii::$app->session->hasFlash('success')) {
    echo '<div class="alert" style="background: #E0FFE0">'.Yii::$app->session->getFlash('success').'</div>';
  }
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-new-course">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to add new user:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'add-course-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-7\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]);

    ?>

        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'description')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'Full-All'
        ]) ?>
        <?= $form->field($model, 'status')->radioList([0 => 'Not active', 1 => 'Active']) ?>
        <?= $form->field($model, 'start_date')->widget(yii\jui\DatePicker::classname(), ['dateFormat'=>'yyyy-MM-dd']) ?>
        <?= $form->field($model, 'end_date')->widget(yii\jui\DatePicker::classname(), ['dateFormat'=>'yyyy-MM-dd']) ?>



        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Create course', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>


</div>
