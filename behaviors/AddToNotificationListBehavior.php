<?php
/**
 * Created by PhpStorm.
 * User: diral
 * Date: 02.03.2018
 * Time: 13:11
 */

namespace app\behaviors;


use app\models\ContactForm;
use app\models\Notification;
use app\models\User;
use yii\base\Behavior;

class AddToNotificationListBehavior extends Behavior
{
    public function events()
    {
        return [
            User::EVENT_AFTER_INSERT => 'addUser',
            ContactForm::EVENT_CONTACT_START => 'addEmail',
        ];
    }


    public function addUser($event)
    {
        Notification::addUserToNotificationList($event->sender);
    }

    public function addEmail($event)
    {
        Notification::addEmailToNotificationList($event->email);
    }
}