<aside class="col-md-8 adminemail">
<div class="line"></div>
<h1>Admin Emails - <span class="blue">Who will receive enquiries and notifications</span></h1>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php
    $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
            'id'=>'admin-email',
            'type'=>'horizontal',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
          ));
?>
        <div><?php echo $form->textFieldRow($model,'email1',array('placeHolder'=>'example@domain.com')); ?></div>

        <div><?php echo $form->textFieldRow($model,'email2',array('placeHolder'=>'example@domain.com')); ?></div>

        <div><?php echo $form->textFieldRow($model,'email3',array('placeHolder'=>'example@domain.com')); ?></div>

        <div><?php echo $form->textFieldRow($model,'email4',array('placeHolder'=>'example@domain.com')); ?></div>

        <div><?php echo $form->textFieldRow($model,'email5',array('placeHolder'=>'example@domain.com')); ?></div>

        <div class="greybg">
        <div style="margin-left:150px;">
        	<?php $this->widget('bootstrap.widgets.BootButton', array(
        		'buttonType'=>'submit',
        		'type'=>'primary',
                'size' =>'large',
        		'label'=>'Submit',
        	)); ?>
            </div>
        </div>
    <div class="clear"></div>
<?php $this->endWidget(); ?>
</aside>

<aside class="col-md-4">
<!-- notification settings -->
<?php
$this->renderPartial('application.modules.admin.views.config._form',array('configModel'=>$configModel));
?>
</aside>
<div class="clear"></div>