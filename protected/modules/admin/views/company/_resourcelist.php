<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bootstrap-tagmanager.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/css/bootstrap-tagmanager.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bootstrap-typeahead.js');
?>
<div class="restaurant_menus_wrapper">
<h2>Resources - <span>Select the resources you provide from the list below</span></h2>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'product-resource-brand-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'update-company-form'),
)); ?>
<!--resources-->
    <div class="features_extra_01">
     <?php $resources->resource_id = $resources->getSelectedResources($companyId);?>
     <?php //$services->service_id = $services->getSelectedServices($companyId);?>
    <div class="left150">
    <?php echo $form->checkBoxList($resources,'resource_id', CompanyResources::listResources()); ?>
    </div>
    <div class="clear"></div>
    </div>

    <div class="features_extra_01">
    <div class="left">
    <span class="blue">Additional <span class="bold">Resources</span></span>
    </div>
    <div class="right">
    <?php if($resources) $addedResources = Resources::model()->getAdditionalResourcesByCompany($companyId); ?>
     <div class="clear"></div>
    <input type="text" name="resource_tag" placeholder="Resources" class="tagManager" id="resource_tag"/>
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'button', 'type'=>'', 'label'=>'+Add','htmlOptions'=>array('id'=>'addResource'))); ?>
    <div class="clear"></div>
    <input type="hidden" value="<?php echo $addedResources;?>" id="addedResources"/>
     <div class="additional"></div>    
     <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="line"></div>
    </div>
<!--resources end-->
<div class="features_extra_01">
	<div class="left">&nbsp;</div>
    <div class="right">
        <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'size'=>'large', 'label'=>'Submit','htmlOptions'=>array('name'=>'btnSubmit'))); ?>
	</div>
    <div class="clear"></div>
</div>

<?php $this->endWidget(); ?>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $("#resource_tag").tagsManager({
        prefilled: $('#addedResources').val(),
        CapitalizeFirstLetter: true,
        preventSubmitOnEnter: true,
        delimeters: [9],
        blinkBGColor_1: '#FFFF9C',
        blinkBGColor_2: '#CDE69C',
        hiddenTagListName: 'hiddenResourceList',
    });
});
</script>