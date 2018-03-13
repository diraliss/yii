<?php

use yii\db\Migration;

/**
 * Class m180313_110036_create_foreign_keys
 */
class m180313_110036_create_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addForeignKey('user_order', 'app_order', 'user_id', 'app_user', 'id');

        $this->addForeignKey('order__order_product', 'app_order_product', 'order_id', 'app_order', 'id');

        $this->addForeignKey('product__order_product', 'app_order_product', 'product_id', 'app_product', 'id');

        $this->addForeignKey('category_product', 'app_product', 'category_id', 'app_category', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_order', 'app_order');
        $this->dropForeignKey('order__order_product', 'app_order_product');
        $this->dropForeignKey('product__order_product', 'app_order_product');
        $this->dropForeignKey('category_product', 'app_product');

        return false;
    }
}
