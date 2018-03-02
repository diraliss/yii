<?php
/**
 * Created by PhpStorm.
 * User: diral
 * Date: 02.03.2018
 * Time: 12:47
 */

namespace app\actions;


use yii\base\Action;

class HelloAction extends Action
{
    public $name = 'Vasya';

    public function run()
    {
        return "Hello, world and {$this->name}!";
    }
}