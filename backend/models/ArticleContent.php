<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article_content".
 *
 * @property string $id
 * @property string $content
 */
class ArticleContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '文章ID',
            'content' => '文章内容',
        ];
    }
}
