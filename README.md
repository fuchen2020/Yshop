# Yshop项目介绍

## 1.1.项目描述简介
  Yshop类似京东商城的B2C商城 
  电商或电商类型的服务在目前来看依旧是非常常用，虽然纯电商的创业已经不太容易，但是各个公司都有变现的需要，所以在自身应用中嵌入电商功能是非常普遍的做法。
  为了让大家掌握企业开发特点，以及解决问题的能力，我们开发一个电商项目，项目会涉及非常有代表性的功能。
  为了让大家掌握公司协同开发要点，我们使用git管理代码。
  在项目中会使用很多前面的知识，比如架构、维护等等。
## 1.2.主要功能模块
   系统包括：
   后台：品牌管理、商品分类管理、商品管理、订单管理、系统管理和会员管理六个功能模块。
   前台：首页、商品展示、商品购买、订单管理、在线支付等。
## 1.3.开发环境和技术
   开发环境	Window
   开发工具	Phpstorm+PHP5.6+GIT+Apache
   相关技术	Yii2.0+CDN+jQuery+sphinx 
# 2.系统功能模块
##2.1.需求分析
- 品牌管理：列表展示、品牌添加、修改、删除功能
- 商品分类管理：列表展示（动态展示）、添加（回显）、修改、删除功能
- 商品管理：列表展示、添加（多图上传回显,富文本）、修改、删除功能
- 账号管理：列表展示、添加（多图上传回显,富文本）、修改、删除功能
- 权限管理：列表展示、添加（多图上传回显,富文本）、修改、删除功能
- 菜单管理：
- 订单管理：
## 2.2.流程
  - 自动登录流程
  - 购物车流程
  - 订单流程
## 2.3.设计要点（数据库和页面交互）
  系统前后台设计：前台www.yiishop.com 后台admin.yiishop.com 对url地址美化
  商品无限级分类设计：
  购物车设计
 
#3.功能模块实现
## 3.1.品牌模块需求
 1.品牌管理功能涉及品牌的列表展示、品牌添加、修改、删除功能。
 2.品牌需要保存缩略图和简介。
 3.品牌删除使用逻辑删除。
 4.数据库设计
 ```php
'id' => $this->primaryKey(),
'name'=>$this->string()->notNull()->comment('名称'),
'intro'=>$this->string()->comment('简介'),
'logo'=>$this->string(200)->comment('品牌logo'),
'sort'=>$this->smallInteger()->comment('排序'),
'status'=>$this->smallInteger()->comment('状态')````
```
#### 品牌回收站
  1.一键还原之前删除的品牌数据
  2.彻底删除品牌数据
#### 要点难点及解决方案
 1.删除使用逻辑删除,只改变status属性,不删除记录
 2.使用webupload插件,提升用户体验
 3.使用composer下载和安装 webupload
 4.composer安装插件报错,解决办法:
 5.实现七牛云图片上传保存
 
 ## 3.1.文章模块需求
 1.文章分类数据库增删改查
 2.文章表和文章内容表的一对一关联增删改查
 #### 数据库设计
 ```sql
 //文章分类
'id' => $this->primaryKey(),
'name'=>$this->string(30)->notNull()->comment('名称'),
'intro'=>$this->string()->comment('简介'),
'status'=>$this->integer()->notNull()->comment('状态'),
'sort'=>$this->smallInteger()->notNull()->defaultValue('10')->comment('排序'),
//文章信息
'id' => $this->primaryKey(),
'name'=>$this->string(30)->notNull()->comment('名称'),
'type'=>$this->smallInteger()->notNull()->comment('文章分类'),
'intro'=>$this->string()->comment('简介'),
'status'=>$this->integer()->notNull()->comment('状态'),
'sort'=>$this->integer()->notNull()->defaultValue('10')->comment('排序'),
'addtime'=>$this->integer()->notNull()->comment('发布时间')
//文章内容
 'id' => $this->primaryKey(),
'article_id'=>$this->integer()->notNull()->comment('文章ID'),
'content'=>$this->text()->comment('文章内容')

```
 ## 3.2.商品分类模块需求
  1.商品分类管理功能涉及商品分类的列表展示、分类添加（回显）、修改、删除功能。
  2.数据库设计
  ```sql
     'id' => $this->primaryKey(),
    'tree' => $this->integer()->notNull()->comment('根目录'),
    'lft' => $this->integer()->notNull()->comment('左值'),
    'rgt' => $this->integer()->notNull()->comment('右值'),
    'depth' => $this->integer()->notNull()->comment('深度'),
    'name' => $this->string()->notNull()->comment('分类名称'),
    'intro'=>$this->string()->comment('简介'),
```
#### 要点难点及解决方案
    1.通过Nested-sets实现分类左值，右值计算，添加分类。
    （https://packagist.org/packages/creocoder/yii2-nested-sets）
    2.添加，修改的分类数据回显，通过利用Z-tree插件实现
    
    3.分类列表数据展示，利用Treegrid插件实现
    （https://packagist.org/packages/leandrogehlen/yii2-treegrid）
    4.解决Treegrid展示的数据ID错乱的问题，重写ActionColumn类；
```php
namespace backend\components;

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

class TreeColumn extends ActionColumn
{
//    public $template = '{:view} {:update} {:delete}';
     public $template = '{:update} {:delete}';
    /**
     * 重写了标签渲染方法。
     * @param mixed $model
     * @param mixed $key
     * @param int $index
     * @return mixed
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        return preg_replace_callback('/\\{([^}]+)\\}/', function ($matches) use ($model, $key, $index) {

            list($name, $type) = explode(':', $matches[1].':'); // 得到按钮名和类型
            if($name == 'view'){
                $url = Yii::$app->request->hostInfo.'/product/'.$model->id.'.html';
                return call_user_func($this->buttons[$type], $url, $model, $key,$options=['target'=>'_blank']);

            }else{
                if (!isset($this->buttons[$type])) { // 如果类型不存在 默认为view
                    $type = 'view';
                }

                if ('' == $name) { // 名称为空，就用类型为名称
                    $name = $type;
                }

                $url = $this->createUrl($name, $model, $key, $index);

                return call_user_func($this->buttons[$type], $url, $model, $key);
            }

        }, $this->template);

    }
    /**
     * 方法重写，让view默认新页面打开
     * @return [type] [description]
     */
    protected function initDefaultButtons(){

        if (!isset($this->buttons['view'])) {
            $this->buttons['view'] = function ($url, $model, $key) {

                $options = array_merge([
                    'title' => Yii::t('yii', 'View'),
                    'aria-label' => Yii::t('yii', 'View'),
                    'data-pjax' => '0',
                    'target'=>'_blank'
                ], $this->buttonOptions);
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '/goods-category/view?id='.$model->id, $options);
            };
        }
        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'Update'),
                    'aria-label' => Yii::t('yii', 'Update'),
                    'data-pjax' => '0',
                ], $this->buttonOptions);
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/goods-caetgory/update?id='.$model->id, $options);
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'Delete'),
                    'aria-label' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ], $this->buttonOptions);
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/goods-caetgory/delete?id='.$model->id, $options);
            };
        }
    }
}
```
 ## 3.3.商品管理模块需求
   1.商品管理功能涉及商品数据的列表展示、分类添加（回显）、多图上传（回显）、富文本编辑器、修改、删除功能。
   2.数据库设计
```sql
   //商品表
'id' => $this->primaryKey(),
'name'=>$this->string(100)->notNull()->comment('商品名称'),
'sn'=>$this->string(30)->notNull()->comment('商品编号'),
'goods_category_id'=>$this->integer()->notNull()->comment('分类ID'),
'brand_id'=>$this->integer()->notNull()->comment('品牌ID'),
'logo_id'=>$this->integer()->notNull()->comment('logoID'),
'market_price'=>$this->decimal(10,2)->notNull()->comment('市场价'),
'price'=>$this->decimal(10,2)->notNull()->comment('本店价'),
'stock'=>$this->integer()->notNull()->comment('库存'),
'status'=>$this->smallInteger()->notNull()->comment('状态'),
'sort'=>$this->integer()->notNull()->comment('排序'),
'create_at'=>$this->integer()->notNull()->comment('添加时间')

//商品图片表
'id' => $this->primaryKey(),
'goods_id'=>$this->integer()->notNull()->comment('商品ID'),
'is_logo'=>$this->string()->notNull()->comment('是否LOGO'),
'img'=>$this->string()->notNull()->comment('图片地址')

//商品详情表

 'goods_id' => $this->integer()->notNull()->comment('商品ID'),
'content'=>$this->text()->notNull()->comment('商品详情')

//商品编号生成统计每天添加商品量表
'id' => $this->primaryKey(),
'day'=>$this->string()->notNull()->comment('年月日'),
'count'=>$this->integer()->notNull()->defaultValue(0)->comment('当日添加商品统计')
```
#### 要点难点及解决方案
    1.通过webupload插件实现多图上传。
    2.多图回显（显示视图前 利用foreach循环追加imgPath属性）
    3.自动生成订单编号
    4.富文本编辑器（利用插件composer）
    (composer require kucha/ueditor)
    5.按商品名称、货号、价格范围、状态条件进行搜索
```php
//多图上传视图
echo $form->field($goods, 'imgPath')->widget('manks\FileInput', [
    'clientOptions' => [
        'pick' => [
            'multiple' => true,
        ],
        'server' => \yii\helpers\Url::to(['upload']),
        'accept' => [
            'extensions' => ['png','jpg','gif'],
        ],
    ],
]);
//富文本编辑器视图
echo $form->field($goodsDetails, 'content')->widget(\bajadev\ckeditor\CKEditor::className(),[
    'editorOptions' => [
        'preset' => 'full', //basic, standard, full
            'inline' => false,
            'filebrowserBrowseUrl' => 'browse-images',
            'filebrowserUploadUrl' => 'upload-images',
            'extraPlugins' => 'imageuploader',
        ],
    ]);
    
//商品添加逻辑处理
/**
     * 添加商品
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $goods=new Goods();
        $goodsDetails=new GoodsDetails();
        $goodsDaycount=new GoodsDayCount();
        $cate=ArrayHelper::map(GoodsCaetgory::find()->where(['depth'=>1])->all(),'id','name');
        $brand=ArrayHelper::map(Brand::find()->all(),'id','name');
        $re=\Yii::$app->request;
        if($re->isPost) {
            $data = $re->post();
//           var_dump($data);exit;
            //绑数据到模型
            $goods->load($data);
            //货号自动生成
            if(empty($data['Goods']['sn'])){
                $ymd=date('Ymd',time());
                $count=$goodsDaycount->findOne(['day'=>$ymd]);
                if(!$count){
                    $goods->sn=$ymd.'0000001';
                }else{
                    $sn=$count->count + 1;
                    $goods->sn=$ymd.substr('0000000'.$sn, -7);
                }
            }
//            var_dump($goods);exit;
            $goodsDetails->load($data);
            //保存商品信息
            if ($goods->save()) {
                //更新每日商品添加数据统计
                if(!$count){
                    $goodsDaycount->day=date('Ymd',time());
                    $goodsDaycount->count=1;
                    $goodsDaycount->insert();
                }else{
                    $count->count=$sn;
                    $count->update();
                }


                //获取商品ID 关联到商品详情ID
                $goodsDetails->goods_id = $goods->id;
                //保存商品详情内容
                $goodsDetails->save();
                //多图循环存入数据库
                foreach ($data['Goods']['imgPath'] as $k => $v) {
                    $goodsImg=new GoodsImg();
                    $goodsImg->goods_id = $goods->id;
                    $goodsImg->img = $v;
                    $goodsImg->save();
                }

            }else{
                var_dump($goods->getErrors());exit;
            }

            \Yii::$app->session->setFlash("success", "添加成功");
            return $this->redirect(['goods/index']);
        }
        return $this->render('add',['goods'=>$goods,'goodsDetails'=>$goodsDetails,'cate'=>$cate,'brand'=>$brand]);
    }
    
    
    //搜索框实现代码
    
    //view部分
    <!--搜索框-->
    <form class="form-inline pull-right" id="device-search" role="form" action="index" method="get">
        <input name="_csrf-backend" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <div class="form-group">
            <input type="text" class="form-control" name="goodsname" placeholder="商品名称或者货号……">
        </div>
        <select class="form-control" name="status">
            <option value="0">待上架</option>
            <option value="1">已上架</option>
        </select>
        <div class="form-group ">
            <input type="text" class="form-control" name="prices" placeholder="最低价格……" size="5px">-
        </div>
        <div class="form-group ">
            <input type="text" class="form-control" name="pricem" placeholder="最高价格……" size="5px">
        </div>
        <button class="btn btn-default">搜索</button>
    </form>
    
    //controller部分逻辑
    
     public function actionIndex()
        {
            $re=\Yii::$app->request;
            $query=Goods::find();
            $name=$re->get('goodsname');
            $status=$re->get('status');
            $prices=$re->get('prices');
            $pricem=$re->get('pricem');
           if(!empty($name))
            {
                $query->andwhere("name like '%{$name}%' or sn like '%{$name}%'");
            }
            if($status=="0" or $status=="1")
            {
                $query->andwhere("status = {$status}");
            }
           if($prices>0){
                $query->andwhere("price >= {$prices}");
            }
            if($pricem>0){
                $query->andwhere( "price <= {$pricem}");
            }
    
            $pageSize=5;
            $pagination=new Pagination(
                [
                    //传递每页显示的条数
                    'pageSize' => $pageSize,
                    //传递数据总条数
                    'totalCount' =>Goods::find()->count(),
                ]
            );
            $goods=$query->limit($pagination->limit)->offset($pagination->offset)->all();
            return $this->render('index',['goods' => $goods,'pagination'=>$pagination]);
        }
    
```
## 3.3.管理员管理模块需求
    1.管理员功能涉及管理员数据的列表展示、添加（回显）、修改、删除功能。
    2.后台自动登陆功能
    3.数据库设计   

```sql
  'id' => 'ID',
'username' => '用户名',
'password' => '密码',
'Salt' => '加盐',
'email' => '邮箱',
'token' => '自动登陆令牌',
'token_create_time' => '令牌创建时间',
'addtime' => '注册时间',
'last_lg_time' => '最后登陆时间',
'last_lg_ip' => '登陆IP',
```
## 3.4.权限管理模块需求
    1.商品管理功能涉及商品数据的列表展示、分类添加（回显）、多图上传（回显）、富文本编辑器、修改、删除功能。
    2.数据库设计



 