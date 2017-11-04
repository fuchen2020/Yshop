<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article_caetgory".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 */
class ArticleCaetgory extends \yii\db\ActiveRecord
{
    public static $status=['1'=>'显示','0'=>'隐藏'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_caetgory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['status', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'intro' => '简介',
            'status' => '状态',
            'sort' => '排序',
        ];
    }
}
