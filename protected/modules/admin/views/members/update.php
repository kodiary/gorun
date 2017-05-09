<div class="col-md-12">
<div class="line"></div>
<h1>Members - <span class="blue">Edit members Here</span></h1>
<div class="line"></div>
<div id="msg"></div>
<?php //$this->renderPartial('_companyHeader',array('model'=>$model));?>
<?php
if(isset($_GET['id']))$id=$_GET['id'];
?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="company-bottom">
<div class="col-md-9">
    <?php echo $this->renderPartial('application.views.dashboard.member_form',array('member'=>$model,'tradinghours'=>$tradinghours)); ?>
</div>
<div class="col-md-3">
    
    <div style="display: none;" id="applyDiv" class="conforminations_toos">
    <div class="lefts">Confirm Apply</div>
    <div class="rights"><?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'button', 'type'=>'info', 'label'=>'Cancel', 'htmlOptions'=>array('onclick'=>"$('#applyDiv').hide();")));?> OR <?php echo CHtml::link('Apply', $applyUrl,array('class'=>'btn btn-primary'));?></div>
    <div class="clear"></div>
    </div>
    <?php
    $previewUrl=$this->createUrl('/'.$model->slug);
    ?>
    <?php //$this->renderPartial('application.modules.restaurant.views.info._noticeSidebar',array('previewUrl'=>$previewUrl));?>
    
    <?php $this->renderPartial('application.modules.admin.views.members._savePopUp');?>

</div>
<div class="clear"></div>
</div>
<div class="clearfix"></div>
