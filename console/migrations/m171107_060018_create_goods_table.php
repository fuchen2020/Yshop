<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m171107_060018_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(100)->notNull()->comment('商品名称'),
            'sn'=>$this->string(30)->notNull()->comment('商品编号'),
            'goods_category_id'=>$this->integer()->notNull()->comment('分类ID'),
            'brand_id'=>$this->integer()->notNull()->comment('品牌ID'),
            'logo_id'=>$this->integer()->notNull()->comment('logoID'),
            'market_price'=>$this->decimal(10,2)->notNull()->comment('市场价'),
            'price'=>$this->decimal(10,2)->notNull()->comment('本店价'),
            'stock'=>$this->integer()->notNull()->comment('库存'),
            'status'=>$this->smallInteger()->notNull()->comment('状态'),
            'sort'=>$this->integer()->notNull()->comment('排序'),
            'create_at'=>$this->integer()->notNull()->comment('添加时间')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
    }
}
