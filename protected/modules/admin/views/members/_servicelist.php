<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bootstrap-tagmanager.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/css/bootstrap-tagmanager.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bootstrap-typeahead.js');
?>
<div class="restaurant_menus_wrapper">
<h2>Services - <span>Select the services you provide from the list below</span></h2>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'product-service-brand-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'update-company-form'),
)); ?>
<!--services-->
    <div class="features_extra_01">
     <?php $services->service_id = $services->getSelectedServices($companyId);?>
    <div class="left150">
    <?php echo $form->checkBoxList($services,'service_id', CompanyServices::listServices()); ?>
    </div>
    <div class="clear"></div>
    </div>

    <div class="features_extra_01">
    <div class="left">
    <span class="blue">Additional <span class="bold">Services</span></span>
    </div>
    <div class="right">
    <?php if($services) $addedServices = Services::model()->getAdditionalServicesByCompany($companyId); ?>
     <div class="clear"></div>
    <input type="text" name="service_tag" placeholder="Services" class="tagManager" id="service_tag"/>
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'button', 'type'=>'', 'label'=>'+Add','htmlOptions'=>array('id'=>'addService'))); ?>
    <div class="clear"></div>
    <input type="hidden" value="<?php echo $addedServices;?>" id="addedServices"/>
     <div class="additional"></div>    
     <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="line"></div>
    </div>
<!--services end-->
<div class="greybg">
    <div style="margin-left: 120px;">
        <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'size'=>'large', 'label'=>'Submit','htmlOptions'=>array('name'=>'btnSubmit'))); ?>
	</div>
    <div class="clear"></div>
</div>

<?php $this->endWidget(); ?>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $("#service_tag").tagsManager({
        prefilled: $('#addedServices').val(),
        CapitalizeFirstLetter: true,
        preventSubmitOnEnter: true,
        delimeters: [9],
        blinkBGColor_1: '#FFFF9C',
        blinkBGColor_2: '#CDE69C',
        hiddenTagListName: 'hiddenServiceList',
    });
});
</script>