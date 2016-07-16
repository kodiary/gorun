<?php
$this->breadcrumbs=array(
	'Banners'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);
?>

<aside class="col-md-8">
<div class="line"></div>
<h2>Advertising Banners - <span class="blue">Add or Edit Banners Here</span></h2>
<div class="line"></div>
<h2 style="font-weight: bold !important;">Add/Edit Banner</h2>
<div class="line"></div>

<?php $this->widget('bootstrap.widgets.BootAlert'); ?>   

<div class="banner_adding_sec">
	<div class="blue floatLeft">
    	<div class="clicks">Views: <?php $countViews = $model->countViews($model->id);
        echo $countViews;?>
        &nbsp;&nbsp;&nbsp;Clicks: <?php $countClicks = $model->countClicks($model->id);echo $countClicks;?>
        &nbsp;&nbsp;&nbsp;CTR: <?php if($countClicks!=0) echo number_format(($countClicks/$countViews)*100,2); else echo '0'?>%</div>
        
    <p>Booked: <?php echo Banner::fullMonthName($model->from_month)?> <?php echo $model->from_year?>  to <?php echo Banner::fullMonthName($model->to_month)?> <?php echo $model->to_year?> <strong>(Banner went live on <?php echo Banner::fullMonthName($model->from_month)?> <?php echo $model->from_year?>)</strong></p>    
    </div>
    <?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Report',
    'url'=>'#banner_popup',
    'htmlOptions'=>array('data-toggle'=>'modal','class'=>'floatRight'),
    )); ?>
    <div class="clear"></div>
    

</div>
<div class="line"></div>
<div class="restaurant_menus_wrapper bannerAdd">
<?php echo $this->renderPartial('_form', array('model'=>$model));?>
</div>
</aside>

<aside class="col-md-4">
<div class="right_btns">
<?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Back to List',
                'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'url' => array('index'),
)); ?>
</div>
</aside>
<div class="clear"></div>

<!-- banner popup --> 
<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'banner_popup')); ?>
 
<div class="reportForm">
<div class="reportFormheader">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Send Banner Report</h3>
</div>
<div id="modal-result" class="reportFormbody">
     <?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
    	'id'=>'report-form',
        'type'=>'horizontal',
        'action'=>array('report'),
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions' => array('validateOnSubmit'=>true,'vaidateOnType'=>true),
    )); ?>
    <div class="">
       <?php echo CHtml::hiddenField('banner_id', $_GET['id']);?>
       <?php echo $form->textFieldRow($report_model,'name');?>
       <?php echo $form->textFieldRow($report_model,'email');?>
    </div>

    <div class="reportFormfooter">
        <?php echo CHtml::ajaxSubmitButton('Submit Report', 
                    $this->createUrl('report'),
                    array('update'=>'#modal-result'),
                    array("class"=>"btn btn-primary btn-large")
                );
        ?>
    </div>
    <?php $this->endWidget();?> <!-- ends form widget -->
</div></div>
<?php $this->endWidget(); ?> <!-- ends modal widget -->
<!-- banner popup ends-->