<?php

use yii\db\Migration;

/**
 * Handles the creation of table `app_category`.
 */
class m180313_104056_create_app_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'app_category',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(100),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('app_category');
    }
}
