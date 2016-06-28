<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
	'htmlOptions'=>array('class'=>'admin_extra01'),
    'items'=>array(
        array('label'=>'Members', 'url'=>array('/admin/company'), 'active'=>((Yii::app()->controller->id=='company' || Yii::app()->controller->id=='membertype' || Yii::app()->controller->id=='services' || Yii::app()->controller->id=='resources') && Yii::app()->controller->action->id!='newlisting')?true:false),
        array('label'=>'Events', 'url'=>array('/admin/events'),'active'=>Yii::app()->controller->id=='events' || Yii::app()->controller->id=='eventstype' || Yii::app()->controller->id=='eventsvisitors' || Yii::app()->controller->id=='eventscategory'),
        array('label'=>'News', 'url'=>array('/admin/articles'), 'active'=>Yii::app()->controller->id=='articles' || Yii::app()->controller->id =='tags'),
        array('label'=>'NewsLetter','url'=>array('/admin/newsletters'),'active'=>Yii::app()->controller->id=='newsletters' || Yii::app()->controller->id=='newslettertemplate' || Yii::app()->controller->id=='subscribers' || Yii::app()->controller->id=='newslettersendlimit' || Yii::app()->controller->id=='subscriberslist'),
        array('label'=>'Pages', 'url'=>array('/admin/contents'),'active'=>Yii::app()->controller->id=='contents' || Yii::app()->controller->id=='accounts'),
        array('label'=>'Banners', 'url'=>array('/admin/banner'),'active'=>Yii::app()->controller->id=='banner' || Yii::app()->controller->id=='slideshow'),
        array('label'=>'Jobs', 'url'=>array('/admin/jobs'), 'active'=>Yii::app()->controller->id=='jobs'),
        array('label'=>'SEO', 'url'=>array('/admin/seo'),'active'=>Yii::app()->controller->id=='seo'),
        array('label'=>'Admin Emails', 'url'=>array('/admin/adminemail'),'active'=>Yii::app()->controller->id=='adminemail'),
    ),
)); ?>
