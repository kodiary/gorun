<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<h2>Contact Accounts</h2>
<div class="line" style="margin: 12px 0 10px;"></div>
<div class="accounts_contacts">

<?php
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'verticalForm',
     //'htmlOptions'=>array('class'=>'well'),
    'enableClientValidation'=>true,
        'clientOptions'=>array(
    		'validateOnSubmit'=>true,
    	),
        'action'=>array('contact'),
)); ?>
<?php echo $form->textFieldRow($model, 'name', array('class'=>'')); ?>
<?php echo $form->textFieldRow($model, 'contact', array('class'=>'')); ?>
<?php echo $form->textFieldRow($model, 'email', array('class'=>'')); ?>
<?php echo $form->textAreaRow($model, 'body', array('class'=>'', 'rows'=>5)); ?>

<p>Your questions or message for accounts</p>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'label'=>'Submit','type'=>'primary','size'=>'large')); ?>
</div>

<?php $this->endWidget(); ?>