<?php

use yii\db\Migration;

/**
 * Handles the creation of table `app_notif`.
 */
class m180313_104126_create_app_notif_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'app_notif',
            [
                'id' => $this->primaryKey(),
                'email' => $this->string(),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('app_notif');
    }
}
