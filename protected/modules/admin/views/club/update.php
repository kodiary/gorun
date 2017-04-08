<div id="msg"></div>
<?php $this->renderPartial('_companyHeader',array('model'=>$model));?>
<?php
if(isset($_GET['id']))$id=$_GET['id'];
?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="company-bottom">
<div class="col-md-8" style="background-color: #C4C4C4;;">
    <?php echo $this->renderPartial('application.views.clubs._form',array('model'=>$model,'events'=>$events)); ?>
</div>
<div class="col-md-4">
    
    <div style="display: none;" id="applyDiv" class="conforminations_toos">
    <div class="lefts">Confirm Apply</div>
    <div class="rights"><?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'button', 'type'=>'info', 'label'=>'Cancel', 'htmlOptions'=>array('onclick'=>"$('#applyDiv').hide();")));?> OR <?php echo CHtml::link('Apply', $applyUrl,array('class'=>'btn btn-primary'));?></div>
    <div class="clear"></div>
    </div>
    <?php
    $previewUrl=$this->createUrl('/'.$model->slug);
    ?>
    <?php //$this->renderPartial('application.modules.restaurant.views.info._noticeSidebar',array('previewUrl'=>$previewUrl));?>
    
    <?php $this->renderPartial('application.modules.admin.views.club._savePopUp');?>

</div>
<div class="clear"></div>
</div>
