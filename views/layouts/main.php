<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $categories = \app\models\Category::find()->all();
    $categoriesList = [];
    foreach ($categories as $category) {
        $categoriesList[] = ['label' => $category->name, 'url' => ['/site/category', 'id' => $category->id]];
    }

    NavBar::begin(
        [
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]
    );
    echo Nav::widget(
        [
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => Yii::t('app_menu', 'main'), 'url' => ['/site/index']],
                [
                    'label' => Yii::t('app_menu', 'categories'),
                    'items' => $categoriesList,
                ],
                Yii::$app->user->isGuest ? ('') : [
                    'label' => Yii::t('app_menu', 'admin'),
                    'url' => ['admin/product/index'],
                ],
                ['label' => Yii::t('app_menu', 'callback'), 'url' => ['/site/contact']],
                ['label' => Yii::t('app_menu', 'about'), 'url' => ['/site/about']],
                Yii::$app->user->isGuest ? (
                ['label' => Yii::t('app_menu', 'login'), 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    .Html::beginForm(['/site/logout'], 'post')
                    .Html::submitButton(
                        Yii::t('app_menu', 'logout').' ('.Yii::$app->user->identity->username.')',
                        ['class' => 'btn btn-link logout']
                    )
                    .Html::endForm()
                    .'</li>'
                ),
            ],
        ]
    );
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
