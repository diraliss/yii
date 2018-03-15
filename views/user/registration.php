<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\User */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-registration">
    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password') ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'user-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
