<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

/* @var $model app\models\Product */
/* @var $singlePage boolean */

if ($singlePage) {
    $this->title = $model->name;
    $this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<div><?= $model->name ?></div>
<div class="card-body">
    <h6><?= $model->price ?> ₽</h6>
    <?php if ($singlePage): ?>
        <p><?= $model->description ?></p>
    <?php else: ?>
        <p><?= mb_strcut($model->description, 0, 100) . "..." ?></p>
    <?php endif; ?>
    <?php if (!$singlePage): ?>
        <?= Html::a(
            'Подробнее',
            [
                'site/details',
                'id' => $model->id,
                'singlePage' => true,
            ],
            ['class' => 'btn btn-primary']
        ) ?>
    <?php endif; ?>
</div>