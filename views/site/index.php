<?php

use yii\helpers\Html;
use \yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Каталог';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Добавить товар', ['product/create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>
    <?= ListView::widget(
        [
            'dataProvider' => $dataProvider,
            "options" => [
                'class' => 'row',
            ],
            'itemView' => 'card',
            'itemOptions' => [
                'class' => 'col-sm-4',
            ],
            'viewParams' => [
                'singlePage' => false
            ],
        ]
    ) ?>
</div>
