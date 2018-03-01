<?php

namespace app\models;

/**
 * This is the model class for table "{{app_product}}".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $price
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{app_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price'], 'required'],
            [['description'], 'string'],
            [['price'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
        ];
    }
}
