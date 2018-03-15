<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\ContactForm */

use app\widgets\Map;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\jui\DatePicker;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

    <?php else: ?>

        <p>
            If you have business inquiries or other questions, please fill out the following form to contact us.
            Thank you.
        </p>

    <?php endif; ?>

    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'subject') ?>
            <?= $form->field($model, 'date')->widget(
                DatePicker::className(),
                [
                    'model' => $model,
                    'attribute' => 'date',
                    'language' => 'ru',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ]
            ) ?>
            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'verifyCode')->widget(
                Captcha::className(),
                [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]
            ) ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
        <div class="col-lg-6">
            <?php
            $key = 'map';
            if ($this->beginCache(
                $key,
                [
                    'duration' => 12 * 60,
//                    'dependency' => '',
                    'variations' => [Yii::$app->language],
//                    'enabled' => false,
                ]
            )) {
                // кэшируется строка statements
                echo $this->renderDynamic(
                    'if (!Yii::$app->user->isGuest) { return "Current user: " . Yii::$app->user->identity->username; } else { return ""; }'
                );
                echo Map::widget();
                $this->endCache();
            }
            ?>
        </div>
    </div>
</div>
