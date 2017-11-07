<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_details`.
 */
class m171107_061051_create_goods_details_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_details', [
            'goods_id' => $this->integer()->notNull()->comment('商品ID'),
            'content'=>$this->text()->notNull()->comment('商品详情')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_details');
    }
}
