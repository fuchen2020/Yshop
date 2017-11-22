<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_detail`.
 */
class m171120_064703_create_order_detail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order_detail', [
            'id' => $this->primaryKey(),
            'order_id'=>$this->integer()->unsigned()->comment('订单ID'),
            'goods_id'=>$this->integer()->unsigned()->comment('商品ID'),
            'goods_name'=>$this->string()->notNull()->comment('商品名称'),
            'goods_logo'=>$this->string()->notNull()->comment('商品logo'),
            'goods_price'=>$this->decimal(10,2)->notNull()->comment('商品单价'),
            'amount'=>$this->integer()->notNull()->comment('购买数量'),
            'subtotal_price'=>$this->decimal(10,2)->notNull()->comment('小计金额')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order_detail');
    }
}
