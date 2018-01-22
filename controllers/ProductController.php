<?php
/**
 * Created by PhpStorm.
 * User: diral
 * Date: 22.01.2018
 * Time: 21:46
 */

namespace app\controllers;


use yii\web\Controller;

class ProductController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', ['title' => 'Title', 'content' => 'Content']);
    }
}