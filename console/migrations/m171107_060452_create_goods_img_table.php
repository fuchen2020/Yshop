<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_img`.
 */
class m171107_060452_create_goods_img_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_img', [
            'id' => $this->primaryKey(),
            'goods_id'=>$this->integer()->notNull()->comment('商品ID'),
            'is_logo'=>$this->string()->notNull()->comment('是否LOGO'),
            'img'=>$this->string()->notNull()->comment('图片地址')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_img');
    }
}
