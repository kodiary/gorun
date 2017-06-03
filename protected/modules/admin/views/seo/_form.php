<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'seo-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    //'htmlOptions'=>array('class'=>'well'),
)); ?>

<div class="seo_form_wraps">
	<?php echo $form->textFieldRow($model,'SeoTitle',array('class'=>'span5','maxlength'=>255)); ?>
    <div class="justify">Title of page - always followed by generic SEO</div>

	<?php echo $form->textAreaRow($model,'SeoDesc',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>
    <div class="justify">160 Character descrption</div>
	<?php echo $form->textFieldRow($model,'SeoKeywords',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>
    <div class="justify">Separated by comma - eg food, drink, dine</div>

    <div class="greybg">
    <div style="margin-left:70px;">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Save',
		)); ?>
        </div>
	</div>
</div>

<?php $this->endWidget(); ?>