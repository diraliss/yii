<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if (Yii::$app->user->can('deleteProduct')): ?>
            <?= Html::a(
                'Delete',
                ['delete', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]
            ) ?>
        <?php else: ?>
            <p>Вам недоступно удаление товара.</p>
        <?php endif; ?>
    </p>

    <?= DetailView::widget(
        [
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'description:ntext',
                'price',
                'created_at',
                'updated_at',
                'category_id',
            ],
        ]
    ) ?>

</div>
