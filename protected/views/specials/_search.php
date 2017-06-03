
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'searchForm',
    'type'=>'search',
    'htmlOptions'=>array('class'=>'well round_search_options', 'onclick'=>'if($("#specialSearch").val()=="") return false;'),
    'method'=>'get',
    'action' =>array('search'),
)); ?>
<?php echo CHtml::textField('keyword','',array('class'=>'input-medium search-query','maxlength'=>50, 'placeholder'=>$keyword?$keyword:'Search Specials', 'id'=>'specialSearch'));?>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'search', 'label'=>'Search')); ?>
 
<?php $this->endWidget(); ?>