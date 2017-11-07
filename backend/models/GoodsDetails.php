<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods_details".
 *
 * @property integer $goods_id
 * @property string $content
 */
class GoodsDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => '商品ID',
            'content' => '商品详情',
        ];
    }
}
