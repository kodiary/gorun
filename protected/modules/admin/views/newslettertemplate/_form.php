<aside class="col-md-8 addArticles">
<div class="line"></div>
<h1>Newsletters Templates - <span class="green">Add or Edit Templates Here</span></h1>
<div class="line"></div>
<div class="subTitle"><h1>Template Editor</h1></div>
<div class="line"></div>
<div class="addContentArea"><?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'newsletters-template-form',
    'type'=>'horizontal',
    'enableClientValidation'=>true,
    'enableAjaxValidation'=>false,
    'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
		<ul>
        
        <li>
        <?php echo $form->labelEx($model,'Title',array('style'=>'display:inline-block; width:156px;')); ?>
		<?php echo $form->textField($model,'title',array('class'=>'titleBox span5','maxlength'=>200,'id'=>'page_title_text')); ?>
        <div class="clear"></div>
        <?php echo $form->error($model,'title'); ?>
        
        <div class="seperator"></div>
        
        </li>
        <li><?php echo $form->labelEx($model,'Template Content'); ?><div class="clear"></div></li>
        
        </ul>

		 <?php
        //ckeditor with ckfinder
        $this->widget('ext.editor.CKkceditor',array(
            "model"=>$model,                # Data-Model
            "attribute"=>'content',     # Attribute in the Data-Model
            "height"=>'200px',
            "width"=>'588px',
            'config' => array(
                'toolbar'=>'Full'),
        ) );
    ?>
		<?php echo $form->error($model,'content'); ?>
        <div class="clear"></div>

        <div class="greybg margintopbot10" style="width:578px; margin-top: 10px;">
		
     <div class="floatLeft">   <?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
            'size' =>'large',
			'label'=>'Submit',
		));?></div>
        <?php if($this->action->id == 'update'){?>
        <div class="floatRight">
        <?php
        if($model->id!=1){
        $del_url = Yii::app()->createUrl('/admin/newslettertemplate/delete/id/'.$model->id);
            $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'delete',
			'type'=>'danger',
            'size' =>'normal',
            //'url' => $del_url,
			'label'=>'Delete',
            'htmlOptions'=>array('id'=>'delete_'.$gettemplate->id,
            'onClick'=>'$("#show_'.$model->id.'").show(400);'),
		)); } ?>
        </div>
        <?php }?>
        <div class="clear"></div>
        </div>
    <div style="display: none;" id="show_<?php echo $model->id?>" class="alert margintopbot10">
    <div class="floatLeft">
        Warning: This cannot be undone. Are you sure?
    </div>
    <div class="floatRight">
        <?php 
            $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'danger',
            'size' =>'normal',
            'url' => $del_url,
			'label'=>'Delete',
        ));?>
        <?php
            $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'cancel',
			'type'=>'normal',
            'size' =>'normal',
			'label'=>'Cancel',
            'htmlOptions'=>array('id'=>'delete_'.$model->id,            
            'onClick'=>'$("#show_'.$model->id.'").hide(400);'),            
		));?>
    </div>
    <div class="clear"></div>
    </div>        
        
<?php $this->endWidget(); ?>
</aside><!-- form -->

<aside class="col-md-4">
        <?php
        $cancel_url = Yii::app()->createUrl('/admin/newslettertemplate/index'); 
            $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'cancel',
			'type'=>'normal',
            'size' =>'normal',
            'url' => $cancel_url,
			'label'=>'Cancel',
		));?>
</aside>

<div class="clear"></div>
