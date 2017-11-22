<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cart`.
 */
class m171119_125623_create_cart_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cart', [
            'id' => $this->primaryKey(),
            'g_id'=>$this->integer()->notNull()->comment('商品ID'),
            'amount'=>$this->integer()->notNull()->comment('购买数量'),
            'u_id'=>$this->integer()->notNull()->comment('用户ID')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cart');
    }
}
