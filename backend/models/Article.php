<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property integer $addtime
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'status'], 'required'],
            [['type', 'status', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 30],
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
            'type' => '文章分类',
            'status' => '状态',
            'sort' => '排序',
        ];
    }

    //注入时间行为

    public function behaviors()
    {
        return[
            [
                'class'=>TimestampBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT=>['addtime','edittime'],
                    self::EVENT_BEFORE_UPDATE=>['edittime']
                ],
            ]
        ];

    }

}
