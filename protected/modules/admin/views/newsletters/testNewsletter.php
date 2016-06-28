<aside class="left_body addArticles">
<?php $this->renderPartial('_newslettermenu');?>

<div class="addContentArea">
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'newsletters-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true),
)); ?>

<div class="margintopbot10">
<label for="test_email" style="display: inline-block;" class="lbl">E-mail Address</label>
<input id="test_email" class="span4 mar-right-10" type="text" maxlength="255" name="email" placeholder="Input Email Address..." />


<?php $this->widget('bootstrap.widgets.BootButton', array(
	'buttonType'=>'submit',
	'type'=>'primary',
	'label'=>'Send Test',
	//'size'=>'large',
    'htmlOptions'=>array('name'=>'btnSubmit')
)); ?>
<?php $this->endWidget(); ?>
</div>
</div>
</aside>
<aside class="right_body addArticles">
    <?php $this->renderPartial('_sidebar'); ?>
</aside>
<div class="clear"></div>