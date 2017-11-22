<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m171120_061548_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'users_id'=>$this->integer()->notNull()->comment('用户ID'),
            'name'=>$this->string()->notNull()->comment('收货人'),
            'province'=>$this->string()->notNull()->comment('省份'),
            'city'=>$this->string()->notNull()->comment('市'),
            'county'=>$this->string()->notNull()->comment('区县'),
            'detailed_address'=>$this->string()->comment('详细地址'),
            'tel'=>$this->string(20)->notNull()->comment('收货人电话'),
            'express_id'=>$this->integer()->comment('快递ID'),
            'express_name'=>$this->integer()->comment('快递名称'),
            'express_price'=>$this->decimal(3,2)->comment('快递价格'),
            'pay_type_id'=>$this->integer()->notNull()->comment('支付类型ID'),
            'pay_type_name'=>$this->string(10)->comment('支付类型名称'),
            'price'=>$this->decimal(10,2)->notNull()->comment('订单总金额'),
            'status'=>$this->integer()->notNull()->defaultValue(1)->comment('订单状态 1 待付款 2 待发货 3 待收货 4 完成 5 取消订单'),
            'third_party_no'=>$this->string()->comment('第三方支付交易号'),
            'create_at'=>$this->integer()->notNull()->comment('创建时间'),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order');
    }
}
