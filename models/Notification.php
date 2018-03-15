<?php

namespace app\models;

/**
 * This is the model class for table "app_notif".
 *
 * @property int $id
 * @property string $email
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{app_notif}}';
    }

    /**
     * @param User $user
     */
    static function addUserToNotificationList($user)
    {
        $notif = new static(['email' => $user->username]);
        $notif->save();
    }

    /**
     * @param string $email
     */
    static function addEmailToNotificationList($email)
    {
        if (!(self::findOne(['email' => $email]))) {
            $notif = new static(['email' => $email]);
            $notif->save();
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
        ];
    }
}
