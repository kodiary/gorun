<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'newsletters-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true),
)); ?>

<ul>

<li class="subs-new"><?php echo $form->textFieldRow($model,'subject',array('class'=>'span5','maxlength'=>255)); ?>
<div class="clear"></div>
</li>

<li class="subs-neww">
<?php echo $form->labelEx($model, 'pub_date');?>
    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model'=>$model,
        'attribute'=>'pub_date',
        // additional javascript options for the date picker plugin
        'options'=>array(
            'showAnim'=>'fold',
            'dateFormat'=>'dd MM yy',
            'minDate'=>0,
            'buttonImage'=>Yii::app()->baseUrl.'/images/calender.png',
            'buttonImageOnly'=>true,
            'showOn'=>"both",
            'constrainInput'=>false,
            //'buttonText'=>'17',
            //'altFormat' => 'dd-mm-yy', // show to user format
        ),
        'htmlOptions'=>array(
            'class'=>'datePickerTxtBox',
            'value'=>($model->pub_date != '0000-00-00') ? CommonClass::formatDate($model->pub_date) : '',
        ),
    ));?>&nbsp;
    <span class="green f12">Date of Article Publication (Optional)</span>
    <div class="clear"></div>

</li>

 <li class="inline-block"><?php echo $form->labelEx($model, 'detail');?>- <span class="blue" style="font-size:12px;">The news story in full</span></li>
 <li class="mar-bot-10">
    <?php $this->widget('application.extensions.editor.CKkceditor',array(
    "model"=>$model,                # Data-Model
    "attribute"=>'detail',         # Attribute in the Data-Model
    "height"=>'400px',
    "width"=>'720px',
   'config' => array('toolbar'=>'Full'),
	"filespath"=>Yii::app()->basePath."/../files/",
	"filesurl"=>Yii::app()->baseUrl."/files/",
    ));?>
    <div class="clear"></div>
 </li>
 <input type="hidden" name="template" value="<?php if($model->isNewRecord){ echo (isset($_GET['template']))?$_GET['template']:0; }else{ echo $model->template_id; }?>"/>
 <li class="greybg">
 <div style="margin-left:70px;">
 <?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Submit',
			'size'=>'large',
            'htmlOptions'=>array('class'=>'floatLeft')
		)); ?>
 </div>
  <?php if(!$model->isNewRecord){?> <a href="javascript:void(0);" onclick="$('#confirmDel').show();" class="btn btn-danger floatRight">Delete</a> <?php }?>
 <div class="clear"></div>
 
 </li>
 
 <li id="confirmDel" style="display: none;" class="alert">
  <div class="floatLeft margintop5"> Warning: This cannot be undone. Are you sure? </div>
    <div class="floatRight">
        <?php 
            $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'danger',
            //'size'=>'', // '', 'large', 'small' or 'mini'
            'url' => $this->createUrl('/admin/newsletters/delete/id/'.$_GET['nid']),
			'label'=>'Delete',
        ));?>
        <?php
            $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'cancel',
            //'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            //'size'=>'', // '', 'large', 'small' or 'mini',
			'label'=>'Cancel',
            'htmlOptions'=>array('onClick'=>'$("#confirmDel").hide(400);'),
            ));
        ?>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
 </li>
</ul>
<?php $this->endWidget(); ?>