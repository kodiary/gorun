<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'searchForm',
    'type'=>'search',
    'htmlOptions'=>array('class'=>'well round_search_options'),
    'method'=>'get',
    'action' =>array('subscriberslist/search')
    
)); ?>
<?php echo CHtml::textField('keyword','',array('class'=>'input-medium search-query','maxlength'=>50, 'placeholder'=>'Search Subscriber List'));?>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'label'=>'Search','icon'=>'search')); ?>
<?php $this->endWidget(); ?>