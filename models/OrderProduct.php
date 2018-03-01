<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%app_order_product}}".
 *
 * @property string $id
 * @property string $order_id
 * @property string $product_id
 * @property string $count
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%app_order_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'count'], 'required'],
            [['order_id', 'product_id', 'count'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'count' => 'Count',
        ];
    }
}
