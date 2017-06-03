<?php
echo "here";die();
?>
<div id="msg"></div>
<?php $this->renderPartial('_companyHeader',array('model'=>$model));?>
<?php
if(isset($_GET['id']))$id=$_GET['id'];
?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="col-md-8">

<h1>Update Events <?php echo $event_model->id; ?></h1>

<?php echo $this->renderPartial('application.modules.admin.views.events._form',array('model'=>$event_model,'venue'=>$venue)); ?>
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
    
    <?php $this->renderPartial('application.modules.admin.views.company._savePopUp');?>

</div>
<div class="clear"></div>