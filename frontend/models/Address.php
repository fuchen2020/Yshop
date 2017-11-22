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
    public $default;
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
            [['users_id', 'consignee', 'province', 'county', 'city','tel','detailed_address'], 'required'],
            [['users_id'], 'integer'],
            [['consignee', 'detailed_address'], 'string', 'max' => 255],
            [['default'],'safe'],
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
            'city' => '县市',
            'county' => '区镇',
            'Detailed_address' => '详细地址',
            'tel' => '收货电话',
        ];
    }

    public function getUname()
    {
        return Users::findOne($this->users_id)->username;
    }
}
