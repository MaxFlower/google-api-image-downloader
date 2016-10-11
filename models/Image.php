<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $title
 * @property string $htmlTitle
 * @property string $link
 * @property integer $bytesSize
 * @property string $thumbnailLink
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'link'], 'required'],
            [['bytesSize'], 'integer'],
            [['title', 'htmlTitle'], 'string', 'max' => 120],
            [['link'], 'string', 'max' => 200],
            [['thumbnailLink'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'htmlTitle' => 'Html Title',
            'link' => 'Link',
            'bytesSize' => 'Bytes Size',
            'thumbnailLink' => 'Thumbnail Link',
        ];
    }
}
