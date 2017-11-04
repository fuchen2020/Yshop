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
- 商品分类管理：
- 商品管理：
- 账号管理：
- 权限管理：
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
 