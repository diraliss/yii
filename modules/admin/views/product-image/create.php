<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\ProductImage */
/* @var $image \app\modules\admin\models\Image */

$this->title = 'Create Product Image';
$this->params['breadcrumbs'][] = ['label' => 'Product Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="product-image-form">

        <?php $form = ActiveForm::begin(
            [
                'options' => [
                    'enctype' => 'multipart/form-data',
                ],
            ]
        ); ?>

        <?= $form->field($image, 'attachment')->fileInput()?>

        <?= $form->field($model, 'is_title')->textInput() ?>

        <?= $form->field($model, 'product_id')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
