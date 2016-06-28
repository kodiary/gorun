<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/selectbox/jquery.selectBox.min.js"));?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/selectbox/jquery.selectBox.css"));?>
<script type="text/javascript">
	$(document).ready( function() {
	$("SELECT")
	.selectBox()
	});
</script>

<ul>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'banner-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<?php if($model->isNewRecord) {
            $model->size = '0';
            $model->opens='1';
            $model->from_month = date('m');
            $model->to_month = date('m');
            $model->links='http://';
            } ?>

	<?php echo $form->errorSummary($model); ?>
	<li>
	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>
    
    <div class="clear"></div>
    <div class="instruction">Banner title</div>
	</li>
    <li>
	<?php echo $form->textFieldRow($model,'alt_tag',array('class'=>'span5','maxlength'=>255)); ?>
	<div class="clear"></div>
    <div class="instruction">Alt title to describe banner for SEO and handicap</div>
    </li>
    <li>
	<?php echo $form->textFieldRow($model,'links',array('class'=>'span5','maxlength'=>255)); ?>
<div class="clear"></div>
<div class="instruction">Website or e-mail that banner should link to</div>
</li>

<li>
<?php echo $form->labelEx($model, 'opens'); ?>

<?php echo $form->radioButtonList($model, 'opens', array('1'=>'New Window', '0'=>'Same Window')); ?>

<div class="clear"></div>
</li>

 <li>
 	<label>From</label>
    <div class="fl_left"><?php echo $form->dropDownList($model,'from_month', Banner::list_month()); ?></div>
    <div class="fl_left">&nbsp;&nbsp;-&nbsp;&nbsp;</div>
    <div class="fl_left"><?php echo $form->dropDownList($model,'from_year', Banner::list_year()); ?></div>
    <div class="clear"></div>
 </li>
 <li>
 	<label>To</label>
    <div class="fl_left"><?php echo $form->dropDownList($model,'to_month', Banner::list_month()); ?></div>
    <div class="fl_left">&nbsp;&nbsp;-&nbsp;&nbsp;</div>
    <div class="fl_left"><?php echo $form->dropDownList($model,'to_year', Banner::list_year()); ?></div>
    <div class="clear"></div>
</li>
<li class="adban"><span class="f12"><strong>Advertising Banner </strong>- Upload JPG, GIF, PNG OR Flash</span></li>
<li>
	
    <?php echo $form->labelEx($model,'size'); ?>
 
   <div class="mod">
    <?php echo $form->radioButtonList($model,'size',array('0'=>'Square Banner <span class="blue"> - 175x175px exactly </span>', '1'=>'Bottom Banner <span class="blue"> - 600x100px exactly </span>'), array('class'=>'banner_type')); ?>
    </div>
    <div class="clear"></div>
    <div class="banner_uploading">
    	 <?php echo $this->renderPartial('bannerupload');?>
		<?php echo $form->hiddenField($model,'image');?>
    </div>
    
    
    <div id="banner">
    <?php if($model->image){
        echo CHtml::image(Yii::app()->baseUrl.'/images/frontend/main/'.$model->image);
    }?>
    </div>
   
    <div class="clear"></div>
</li>
<li>

<div class="line"></div>
<div class="banner-upload blue">Select banner to upload</div>
<div class="line"></div>
 </li>
 <li>
	<div class="submit" style="margin-left: 120px;">
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary','label'=>'Submit',htmlOptions=>array('class'=>'btn-large')
)); ?>
	</div>
    </li>

<?php $this->endWidget(); ?>
</ul>

