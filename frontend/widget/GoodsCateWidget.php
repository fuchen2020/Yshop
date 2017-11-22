<?php
/**
 * Created by PhpStorm.
 * Author: Floating dust
 * Date: 2017-11-17
 * Time: 22:10
 */

namespace frontend\widget;


use backend\models\GoodsCaetgory;
use yii\base\Widget;
use yii\helpers\Html;

class GoodsCateWidget extends Widget
{

    //是不是首页
    public $isIndex=false;



    public function run()
    {

        //1>得到缓存
        $cateId="goodsCategory".$this->isIndex;
        //得到缓存
        $html=\Yii::$app->cache->get($cateId);
        // var_dump($html);exit;
        if ($html!=false){

            return $html;
        }

        //1.得到所有一级分类
        $cates = GoodsCaetgory::find()->where(['parent_id' => 0])->all();

        //2.循环取取
        $html = "";
        foreach ($cates as $k1 => $v1) {

            $html .= '<div class="cat ' . ($k1 == 0 ? "item1" : "") . '">';
            $html .= '<h3>' . Html::a($v1->name, ['index/list', 'id' => $v1->id]) . '<b></b></h3>';
            $html .= ' <div class="cat_detail">';

            //3.循环取出二级分类
            foreach ($v1->children as $k2 => $v2) {
                $html .= '<dl class="dl_1st">';
                $html .= '<dt>' . Html::a($v2->name, ['index/list', 'id' => $v2->id]) . '</dt>';
                $html .= '  <dd>';
                foreach ($v2->children as $k3 => $v3) {
                    $html .= Html::a($v3->name, ['index/list', 'id' => $v3->id]);
                }
                $html .= '</dd></dl>';

            }
            $html .= '</div></div>';
        }
        //根据是不是首页加cat1类
        $cat1=$this->isIndex?"":"cat1";
        //非首页加none类
        $none=$this->isIndex?"":"none";

        $fullHtml=<<<EOF
          <div class="category fl {$cat1}"> <!-- 非首页，需要添加cat1类 -->
            <div class="cat_hd">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
                <h2>全部商品分类</h2>
                <em></em>
            </div>
    <div class="cat_bd {$none}">

{$html};
       
            </div>
     </div>
EOF;
        //存储缓存
        \Yii::$app->cache->set($cateId,$fullHtml,60*60*24);
        return  $fullHtml;

    }

}