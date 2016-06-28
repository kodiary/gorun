<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
	'htmlOptions'=>array('class'=>'admin_extra02'),
    'items'=>array(
        array('label'=>'Cuisine', 'url'=>array('foodtypes'), 'active'=>Yii::app()->controller->action->id=='foodtypes'),
        array('label'=>'Ambience', 'url'=>array('ambience'), 'active'=>Yii::app()->controller->action->id=='ambience'),
        array('label'=>'Capacity', 'url'=>array('capacity'), 'active'=>Yii::app()->controller->action->id=='capacity'),
        array('label'=>'Per head', 'url'=>array('costperhead'), 'active'=>Yii::app()->controller->action->id=='costperhead'),
        array('label'=>'Entertainment', 'url'=>array('entertainment'), 'active'=>Yii::app()->controller->action->id=='entertainment'),
        array('label'=>'Facilities', 'url'=>array('facilities'), 'active'=>Yii::app()->controller->action->id=='facilities'),
        array('label'=>'Cards', 'url'=>array('cards'), 'active'=>Yii::app()->controller->action->id=='cards'),
        array('label'=>'Associations', 'url'=>array('associations'), 'active'=>Yii::app()->controller->action->id=='associations'),        
        array('label'=>'Dress Code', 'url'=>array('dresscode'), 'active'=>Yii::app()->controller->action->id=='dresscode'),
       array('label'=>'Meals', 'url'=>array('meals'), 'active'=>Yii::app()->controller->action->id=='meals'),
       array('label'=>'Admin Emails', 'url'=>array('email'), 'active'=>Yii::app()->controller->action->id=='email'),
	   array('label'=>'Emails', 'url'=>array('customizeEmail'), 'active'=>(Yii::app()->controller->action->id=='customizeemail' || Yii::app()->controller->action->id=='editcustomemail')?true:false),
        
))); ?>