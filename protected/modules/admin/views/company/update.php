<div id="msg"></div>
<?php $this->renderPartial('_companyHeader',array('model'=>$model));?>
<?php
if(isset($_GET['id']))$id=$_GET['id'];
?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="company-bottom">
<div class="left_body">
    <?php echo $this->renderPartial('_form',array('model'=>$model,'tradinghours'=>$tradinghours)); ?>
</div>
<div class="right_body">
    
    <div style="display: none;" id="applyDiv" class="conforminations_toos">
    <div class="lefts">Confirm Apply</div>
    <div class="rights"><?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'button', 'type'=>'info', 'label'=>'Cancel', 'htmlOptions'=>array('onclick'=>"$('#applyDiv').hide();")));?> OR <?php echo CHtml::link('Apply', $applyUrl,array('class'=>'btn btn-primary'));?></div>
    <div class="clear"></div>
    </div>
    <?php
    $previewUrl=$this->createUrl('/'.$model->slug);
    ?>
    <?php //$this->renderPartial('application.modules.restaurant.views.info._noticeSidebar',array('previewUrl'=>$previewUrl));?>
    
    <?php $this->renderPartial('application.modules.admin.views.company._savePopUp');?>

</div>
<div class="clear"></div>
</div>
