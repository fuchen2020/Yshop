<?php
/**
 * Created by PhpStorm.
 * Author: Floating dust
 * Date: 2017-11-05
 * Time: 19:30
 */

namespace backend\models;


use yii\db\ActiveRecord;

class Dels extends ActiveRecord
{
    public static function tableName()
    {
        return 'goods_caetgory';
    }
}