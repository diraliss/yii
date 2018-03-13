<?php

namespace app\controllers;

use app\actions\HelloAction;
use app\models\Category;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\Product;
use app\models\ProductSearch;
use Yii;
use yii\caching\DbDependency;
use yii\filters\AccessControl;
use yii\filters\PageCache;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            [
                'class' => PageCache::className(),
                'only' => [
                    'about',
                ],
                'duration' => 12 * 60,
                'variations' => Yii::$app->language,
            ],
            [
                'class' => PageCache::className(),
                'only' => [
                    'index',
                ],
                'duration' => 12 * 60,
                'variations' => [
                    Yii::$app->request->get('page'),
                    Yii::$app->language
                ],
                'dependency' => [
                    'class' => DbDependency::className(),
                    'sql' => 'SELECT COUNT(*) FROM app_product',
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'hello' => [
                'class' => HelloAction::className(),
                'name' => 'Masha',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'index',
            [
                'dataProvider' => $dataProvider,
                'category' => null,
            ]
        );
    }

    /**
     * @param string $id
     * @param bool $singlePage
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionDetails($id, $singlePage = false)
    {
        $cache = Yii::$app->cache;
        $key = "product_{$id}";
        $dependency = new DbDependency();
        $dependency->sql = "SELECT updated_at FROM app_product WHERE id = {$id}";

        if (!($model = $cache->get($key))) {
            $model = Product::findOne($id);
            $cache->set($key, $model, 6 * 60 * 60, $dependency);
        }

        if ($model !== null) {
            return $this->render(
                'card',
                [
                    'model' => $model,
                    'singlePage' => $singlePage,
                ]
            );
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionCategory($id)
    {
        $cache = Yii::$app->cache;
        $key = "category_{$id}";
        $dependency = new DbDependency();
        $dependency->sql = "SELECT COUNT(*) FROM app_product WHERE category_id = {$id}";

        if (!($content = $cache->get($key))) {
            $searchModel = new ProductSearch();
            $params = Yii::$app->request->queryParams;
            $params['id'] = null;
            $params['category_id'] = (int)$id;
            $dataProvider = $searchModel->search($params);
            $category = Category::findOne($id);

            $content = [
                'dataProvider' => $dataProvider,
                'category' => $category,
            ];

            $cache->set(
                $key,
                $content,
                12 * 60 * 60,
                $dependency
            );
        }

        if ($content['category'] !== null) {
            return $this->render(
                'index',
                [
                    'dataProvider' => $content['dataProvider'],
                    'category' => $content['category'],
                ]
            );
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render(
            'login',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }

        return $this->render(
            'contact',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
