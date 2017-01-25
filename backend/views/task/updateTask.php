<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\widgets\FileInput;

$this->title = 'Update task';
if (Yii::$app->session->hasFlash('success')) {
    echo '<div class="alert" style="background: #E0FFE0">' . Yii::$app->session->getFlash('success') . '</div>';
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-new-course">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'add-course-form',
        'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
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
    <?= $form->field($model, 'create_date')->widget(yii\jui\DatePicker::classname(), ['dateFormat' => 'yyyy-MM-dd']) ?>
    <?= $form->field($model, 'publish_date')->widget(yii\jui\DatePicker::classname(), ['dateFormat' => 'yyyy-MM-dd']) ?>
    <?php
    if ($model->upload != null) {
        echo $form->field($model, 'files')->widget(FileInput::classname(), [
            'options' => ['multiple' => false],
            'pluginOptions' => [
                'initialPreview' =>
                    Yii::getAlias('@frontend') . '/web' . $model->upload,
            ],
        ]);
    } else {
        echo $form->field($model, 'files')->widget(FileInput::classname(), [
            'options' => ['multiple' => false],


        ]);
    }


     ?>


    <div class="form-group" >
        <div class="col-lg-offset-1 col-lg-11" >
            <?= Html::submitButton('Update task', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
</div>
</div>

<?php ActiveForm::end(); ?>


</div>
