<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $news_id
 * @property string $news_title
 * @property string $news_short_desc
 * @property string $news_content
 * @property string $news_image
 * @property integer $deleted
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_title', 'news_short_desc', 'news_content', 'news_image'], 'required'],
            [['news_short_desc', 'news_content'], 'string'],
            [['deleted'], 'integer'],
            [['news_title', 'news_image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'News ID',
            'news_title' => 'News Title',
            'news_short_desc' => 'News Short Desc',
            'news_content' => 'News Content',
            'news_image' => 'News Image',
            'deleted' => 'Deleted',
        ];
    }
}
