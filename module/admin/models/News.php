<?php

namespace app\module\admin\models;

use Yii;

class News extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'news';
    }

    public $fileUpload;
    public $fileEdit;

    public function rules()
    {
        return [
            [['news_title', 'news_short_desc', 'news_content', 'news_image'], 'required'],
            [['news_short_desc', 'news_content'], 'string'],
            [['deleted'], 'integer'],
            [['fileUpload'], 'file'],
            [['fileEdit'], 'file'],
            [['news_title', 'news_image'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'news_id' => 'News ID',
            'news_title' => 'Tiêu đề bài viết',
            'news_short_desc' => 'Mô tả ngắn',
            'news_content' => 'Nội dung bài viết',
            'news_image' => 'Hình ảnh chính',
            'deleted' => 'Deleted',
            'fileUpload' => 'Hình ảnh chính',
            'fileEdit' => 'Thay thế hình ảnh'
        ];
    }
}
