<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m171103_080321_create_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull()->comment('名称'),
            'intro'=>$this->string()->comment('简介'),
            'logo'=>$this->string(200)->comment('品牌logo'),
            'sort'=>$this->smallInteger()->comment('排序'),
            'status'=>$this->smallInteger()->comment('状态')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('brand');
    }
}
