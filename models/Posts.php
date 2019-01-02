<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%posts}}".
 *
 * @property string $post_id
 * @property string $title
 * @property string $body
 * @property string $created_at
 * @property string $updated_at
 * @property string $author
 * @property string $image_url
 * @property string $video_url
 */
class Posts extends \yii\db\ActiveRecord
{
       /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%posts}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body', 'author'], 'required'],
            [['body'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'author', 'image_url', 'video_url'], 'string', 'max' => 191],
            [['title'], 'unique'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'title' => 'Title',
            'body' => 'Body',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'author' => 'Author',
            'image_url' => 'Image Url',
            'video_url' => 'Video Url',
        ];
    }
}
