<?php

use yii\db\Migration;

/**
 * Handles the creation of table `app_user`.
 */
class m180313_104234_create_app_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('app_user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100),
            'password' => $this->string(),
            'authKey' => $this->string(),
            'accessToken' => $this->string(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('app_user');
    }
}
