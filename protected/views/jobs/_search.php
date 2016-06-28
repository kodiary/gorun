<div class="green-form-search">
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'searchForm',
    'type'=>'search',
    'htmlOptions'=>array('class'=>''),
    'method'=>'get',
    'action' =>array('jobs/search'),
)); ?>
<?php echo CHtml::textField('keyword','',array('class'=>'','maxlength'=>50, 'placeholder'=>'Search Jobs'));?>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'htmlOptions'=>array('class'=>'btn btn-info'), 'label'=>'Search')); ?>
<?php $this->endWidget(); ?>
</div>