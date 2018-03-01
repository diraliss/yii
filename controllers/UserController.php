<?php
/**
 * Created by PhpStorm.
 * User: diral
 * Date: 01.03.2018
 * Time: 21:39
 */

namespace app\controllers;


use app\models\Notification;
use app\models\User;
use Yii;
use yii\web\Controller;

class UserController extends Controller
{

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->on(
            User::EVENT_AFTER_INSERT,
            function ($event) {
                Notification::addUserToNotificationList($event->sender);
            }
        );
        $model->on(
            User::EVENT_BEFORE_INSERT,
            function ($event) {
                User::addSecurityKeys($event->sender);
            }
        );


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->user->login($model);
            return $this->redirect(['site/index']);
        }

        return $this->render(
            'registration',
            [
                'model' => $model,
            ]
        );
    }
}