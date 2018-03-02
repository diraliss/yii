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
        $beforeEvent = function ($event) {
            User::addSecurityKeys($event->sender);
        };
        $model->on(
            User::EVENT_BEFORE_INSERT,
            $beforeEvent
        );


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->user->login($model);
            $model->off(
                User::EVENT_BEFORE_INSERT,
                $beforeEvent
            );

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