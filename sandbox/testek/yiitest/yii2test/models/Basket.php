<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dw_basket".
 *
 * @property string $id
 * @property string $name
 * @property string $price
 * @property string $on_sale
 */
class Basket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dw_basket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['price'], 'integer'],
            [['on_sale'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Azonosito',
            'name' => 'Nev',
            'price' => 'Ar',
            'on_sale' => 'Akcios',
        ];
    }

    public static function getTotal($provider, $fieldName)
    {
        $total = 0;

        foreach ($provider as $item) {
            $total += $item[$fieldName];
        }

        // add number_format() before return
        $total = number_format( $total, 2 );

        return $total;
    }

}
