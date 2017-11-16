<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property integer $users_id
 * @property string $consignee
 * @property string $province
 * @property string $county
 * @property string $town
 * @property string $Detailed_address
 * @property string $tel
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['users_id', 'consignee', 'province', 'county', 'town'], 'required'],
            [['users_id'], 'integer'],
            [['consignee', 'Detailed_address'], 'string', 'max' => 255],
            [['province', 'county', 'town', 'tel'], 'string', 'max' => 20],
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
            'consignee' => '收货人',
            'province' => '省份',
            'county' => '县市',
            'town' => '区镇',
            'Detailed_address' => '详细地址',
            'tel' => '收货电话',
        ];
    }
}
