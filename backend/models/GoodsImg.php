<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods_img".
 *
 * @property integer $goods_id
 * @property string $is_logo
 * @property string $img
 */
class GoodsImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img','goods_id'], 'required'],
            [['goods_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => '商品ID',
            'img' => '商品图片',
        ];
    }
}
