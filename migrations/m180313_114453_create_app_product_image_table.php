<?php

use yii\db\Migration;

/**
 * Handles the creation of table `app_product_image`.
 */
class m180313_114453_create_app_product_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'app_product_image',
            [
                'id' => $this->primaryKey(),
                'url' => $this->string(),
                'is_title' => $this->boolean(),
                'product_id' => $this->integer(11),
                'created_at' => $this->timestamp(),
                'updated_at' => $this->timestamp(),
            ]
        );

        $this->addForeignKey('product_image', 'app_product_image', 'product_id', 'app_product', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('app_product_image');
    }
}
