<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $cat_id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $deleted
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['deleted'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'Cat ID',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'deleted' => 'Deleted',
        ];
    }
}
