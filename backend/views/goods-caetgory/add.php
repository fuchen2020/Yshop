<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo '<span style="font-weight: bold;font-size: 16px;">选择父目录：</span>&nbsp;'. \liyuze\ztree\ZTree::widget([
    'setting' => '{
            callback: {
		        onClick: function(event, treeId, treeNode){
		        console.dir(treeNode);
		        $("#goodscaetgory-parent_id").val(treeNode.id);
		        }
	     },
			data: {
				simpleData: {
					enable: true,
					idKey: "id",
			        pIdKey: "parent_id",
			        rootPId: 0
				}
			}
		}',
    'nodes' => $catess,
]);
echo $form->field($model,'parent_id');
echo $form->field($model,'intro');
echo \yii\bootstrap\Html::submitButton('添加分类',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();