<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property integer $sort
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
    public static $status=['0'=>'隐藏','1'=>'显示'];
    //图片上传
//    public $imgFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','sort','intro',], 'required'],
            [['sort', 'status'], 'integer'],
            [['name', 'intro'], 'string', 'max' => 255],
            [['logo'], 'string', 'max' => 200],
//         [['imgFile'],'file','extensions' => ['png','jpg','gif'],'skipOnEmpty' =>true],
//            [['imgFile'],'safe']
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
            'sort' => '排序',
            'status' => '状态',
//            'imgFile'=>'LOGO'
        ];
    }
}
