<?php
/**
 * Created by PhpStorm.
 * Author: Floating dust
 * Date: 2017-11-05
 * Time: 15:05
 */

namespace backend\components;


use yii\db\ActiveQuery;
use creocoder\nestedsets\NestedSetsQueryBehavior;

class MenuQuery extends ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}