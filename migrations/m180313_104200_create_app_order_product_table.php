<?php

use yii\db\Migration;

/**
 * Handles the creation of table `app_order_product`.
 */
class m180313_104200_create_app_order_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('app_order_product', [
            'id' => $this->primaryKey(),
            'product_count' => $this->smallInteger(),
            'order_id' => $this->integer(11),
            'product_id' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('app_order_product');
    }
}
