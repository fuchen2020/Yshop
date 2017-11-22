<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $users_id
 * @property string $name
 * @property string $province
 * @property string $city
 * @property string $county
 * @property string $detailed_address
 * @property string $tel
 * @property integer $express_id
 * @property integer $express_name
 * @property string $express_price
 * @property integer $pay_type_id
 * @property string $pay_type_name
 * @property string $price
 * @property integer $status
 * @property string $third_party_no
 * @property integer $create_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['users_id', 'name', 'province', 'city', 'county', 'tel', 'pay_type_id', 'price', 'create_at'], 'required'],
            [['users_id', 'express_id', 'pay_type_id', 'status', 'create_at'], 'integer'],
            [['express_price', 'price'], 'number'],
            [['name', 'province', 'city', 'county', 'detailed_address', 'third_party_no'], 'string', 'max' => 255],
            [['tel'], 'string', 'max' => 20],
            [['pay_type_name'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'users_id' => '用户ID',
            'name' => '收货人',
            'province' => '省份',
            'city' => '市',
            'county' => '区县',
            'detailed_address' => '详细地址',
            'tel' => '收货人电话',
            'express_id' => '快递ID',
            'express_name' => '快递名称',
            'express_price' => '快递价格',
            'pay_type_id' => '支付类型ID',
            'pay_type_name' => '支付类型名称',
            'price' => '订单总金额',
            'status' => '订单状态 1 待付款 2 待发货 3 待收货 4 完成 5 取消订单',
            'third_party_no' => '第三方支付交易号',
            'create_at' => '创建时间',
        ];
    }
}
