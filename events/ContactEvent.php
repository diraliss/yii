<?php
/**
 * Created by PhpStorm.
 * User: diral
 * Date: 02.03.2018
 * Time: 0:27
 */

namespace app\events;


use yii\base\Event;

class ContactEvent extends Event
{
    public $email;
}