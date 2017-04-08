<div class="admin_search_form">
<?php  $model=new Company;?>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'searchForm',
    'type'=>'search',
    'htmlOptions'=>array('class'=>'well'),
    'method'=>'get',
    'action' =>array('index'),

)); ?>
<?php echo CHtml::textField('key','',array('class'=>'input-medium search-query','maxlength'=>50,'placeholder'=>'Search Members'));?>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'search', 'label'=>'Search')); ?>
 
<?php $this->endWidget(); ?>
</div>