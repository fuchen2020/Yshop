<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property integer $goods_category_id
 * @property integer $brand_id
 * @property integer $logo_id
 * @property string $market_price
 * @property string $price
 * @property integer $stock
 * @property integer $status
 * @property integer $sort
 * @property integer $create_at
 */
class Goods extends \yii\db\ActiveRecord
{
    public static $statu=[0=>'待上架',1=>'上架'];
    public $imgPath=[];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'goods_category_id', 'brand_id','market_price','imgPath','price', 'stock', 'status', 'sort','logo'], 'required'],
            [['goods_category_id', 'brand_id','stock', 'status', 'sort', 'create_at'], 'integer'],
            [['market_price', 'price'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['sn'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'sn' => '商品编号',
            'goods_category_id' => '分类ID',
            'brand_id' => '品牌ID',
            'logo' => '商品logo',
            'market_price' => '市场价',
            'price' => '本店价',
            'stock' => '库存',
            'status' => '状态',
            'sort' => '排序',
            'create_at' => '添加时间',
            'imgPath'=>'商品图片',
        ];
    }

    public function behaviors()
    {
        return[
            [
                'class'=>TimestampBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT=>['create_at'],
                    self::EVENT_BEFORE_UPDATE=>['create_at'],
                ],
            ]
        ];
    }

    /**
     * 商品分类获取器
     * @return string
     */
    public function getCateName()
    {
        return GoodsCaetgory::findOne($this->goods_category_id);
    }

    /**
     * 查询父级分类名称
     * @return string
     */
    public function getCateParent()
    {
        return GoodsCaetgory::findOne(GoodsCaetgory::findOne($this->goods_category_id)->parent_id);
    }

    /**
     * 商品品牌获取器
     * @return string
     */
    public function getBrandLogo()
    {
        return Brand::findOne($this->brand_id)->logo;
    }

    /**
     * 获取商品状态
     * @return mixed
     */
    public function getStatuss()
    {
        return self::$statu[$this->status];
    }

    /**
     * 获取商品详情
     * @return string
     */
    public function getDetail()
    {
        return GoodsDetails::findOne(['goods_id'=>$this->id])->content;
    }

    /**
     * 获取商品详情多图
     * @return mixed
     */
    public function getImgs()
    {
        return GoodsImg::find()->where(['goods_id'=>$this->id])->asArray()->all();
    }

}
