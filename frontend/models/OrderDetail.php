<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order_detail".
 *
 * @property integer $id
 * @property string $order_id
 * @property string $goods_id
 * @property string $goods_name
 * @property string $goods_logo
 * @property string $goods_price
 * @property integer $amount
 * @property string $subtotal_price
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'goods_id', 'amount'], 'integer'],
            [['goods_name', 'goods_logo', 'goods_price', 'amount', 'subtotal_price'], 'required'],
            [['goods_price', 'subtotal_price'], 'number'],
            [['goods_name', 'goods_logo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => '订单ID',
            'goods_id' => '商品ID',
            'goods_name' => '商品名称',
            'goods_logo' => '商品logo',
            'goods_price' => '商品单价',
            'amount' => '购买数量',
            'subtotal_price' => '小计金额',
        ];
    }
}
