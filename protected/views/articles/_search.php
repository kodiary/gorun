<div class="green-form-search">
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'search_event',
    'type'=>'search',
    'htmlOptions'=>array('class'=>''),
    'method'=>'get',
    'action' =>array('news/search'),
)); ?>
<?php echo CHtml::textField('keyword','',array('class'=>'','maxlength'=>50, 'placeholder'=>'Search News'));?>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'label'=>'Search','htmlOptions'=>array('class'=>'btn btn-info'))); ?>
<?php $this->endWidget(); ?>
</div> 