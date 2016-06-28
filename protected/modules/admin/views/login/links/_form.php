<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/selectbox/jquery.selectBox.min.js"));?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/selectbox/jquery.selectBox.css"));?>
<script type="text/javascript">
	$(document).ready( function() {
	$("SELECT")
	.selectBox()
	});
</script>
<div class="blue_bord_d">
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'links-form',
    'type'=>'horizontal',
    // 'htmlOptions'=>array('class'=>'well'),
     /*'enableClientValidation'=>true,
     'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),*/
)); ?>

    <?php if(!$model->isNewRecord && $model->LinkId>1){
        if($model->ProvinceId && $model->AreaId=='')
            $model->area = $model->ProvinceId;
        elseif($model->ProvinceId && $model->AreaId)
            $model->area  = 'Area_'.$model->AreaId;
        $readOnly = array('disabled'=>'disabled');?>
        <p class="fl_left">Area/Grouped Area</p>
        <p class="fl_left a001"><?php echo $form->dropDownList($model, 'area', Region::regionlist()+Links::listAllArea(),$readOnly);?></p>
    <?php }
    elseif($model->isNewRecord){
        $readOnly=array('empty'=>'Select Province');
        echo $form->dropDownListRow($model, 'area', Links::listAllProvince()+Links::listAllArea(),$readOnly);
    }    
    elseif($model->LinkId==1){?>
    <p class="fl_left">Area/Grouped Area</p>
     <p class="fl_left a001" style="font-weight: bold;">Home</p> 
      
    <?php }?>
    
<div class="clear"></div> 
<div>

   <p class="fl_left a002"  style="font-weight: bold;"> Hotels Links</p>
    <div class="clear"></div>
	<?php echo $form->textFieldRow($model,'Url1',array('class'=>'span5','maxlength'=>255)); ?>
    <p class="fl_left a002"  style="font-weight: bold;">Bed and Breakfasts Links</p>
    <div class="clear"></div>
    <?php echo $form->textFieldRow($model,'Url2',array('class'=>'span5','maxlength'=>255)); ?>
	
    <div style="margin-left:160px;">
	
    <?php $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'Save',
            'type'=>'primary', 
            'size'=>'large', 
            'buttonType'=>'submit',
            //'htmlOptions'=>array('name'=>'submit'),
        )); 
    ?>
	</div>
</div>
</div>

<?php $this->endWidget(); ?>
