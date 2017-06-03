<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'searchForm',
    'type'=>'search',
    'htmlOptions'=>array('class'=>'well round_search_options'),
    'method'=>'get',
    'action' =>array('index'),
)); ?>
<?php echo CHtml::textField('keyword','',array('class'=>'input-medium search-query','maxlength'=>50, 'placeholder'=>'Search Jobs'));?>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit','icon'=>'search', 'label'=>'Search')); ?>
<?php $this->endWidget(); ?>