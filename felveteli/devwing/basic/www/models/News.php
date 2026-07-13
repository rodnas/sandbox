<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dw_news".
 *
 * @property string $id
 * @property string $label
 * @property string $shortDescription
 * @property string $description
 * @property string $listIMG
 * @property string $pageIMG
 * @property string $active
 * @property string $insertWhen
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dw_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['active'], 'integer'],
            [['insertWhen'], 'safe'],
            [['label', 'listIMG', 'pageIMG'], 'string', 'max' => 100],
            [['shortDescription'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'shortDescription' => 'Short Description',
            'description' => 'Description',
            'listIMG' => 'List Img',
            'pageIMG' => 'Page Img',
            'active' => 'Active',
            'insertWhen' => 'Insert When',
        ];
    }
}
