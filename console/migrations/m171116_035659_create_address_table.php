<?php

use yii\db\Migration;

/**
 * Handles the creation of table `address`.
 */
class m171116_035659_create_address_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('address', [
            'id' => $this->primaryKey(),
            'users_id'=>$this->integer()->notNull()->comment('用户ID'),
            'consignee'=>$this->string()->notNull()->comment('收货人'),
            'province'=>$this->string(20)->notNull()->comment('省份'),
            'county'=>$this->string(20)->notNull()->comment('县市'),
            'town'=>$this->string(20)->notNull()->comment('区镇'),
            'Detailed_address'=>$this->string()->notNull()->defaultValue('')->comment('详细地址'),
            'tel'=>$this->string(20)->comment('收货电话'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('address');
    }
}
