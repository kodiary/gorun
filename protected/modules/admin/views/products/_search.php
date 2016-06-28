<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'searchForm',
    'type'=>'search',
    'htmlOptions'=>array('class'=>'well round_search_options'),
    'method'=>'get',
     'action'=>$this->createUrl('/admin/products'),
)); ?>
<?php echo CHtml::textField('keyword','',array('class'=>'input-medium search-query','maxlength'=>50, 'placeholder'=>'Search Products'));?>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'label'=>'Search')); ?>
<?php $this->endWidget(); ?>
