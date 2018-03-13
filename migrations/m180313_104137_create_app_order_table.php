<?php

use yii\db\Migration;

/**
 * Handles the creation of table `app_order`.
 */
class m180313_104137_create_app_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('app_order', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('app_order');
    }
}
