<?php

use yii\db\Migration;

/**
 * Handles the creation of table `app_product`.
 */
class m180313_104222_create_app_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'app_product',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'description' => $this->text(),
                'price' => $this->smallInteger(),
                'category_id' => $this->integer(11),
                'created_at' => $this->timestamp(),
                'updated_at' => $this->timestamp(),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('app_product');
    }
}
