 <?php if(isset($_GET['nid']) && $_GET['nid']!='')
         {
            $model = Newsletters::model()->findByPk($_GET['nid']);
            $number=$model->number;
         }
         else
         {
            $number=Newsletters::findmaxnumber()+1;
         }
   ?>
 <div class="line"></div>
 <h1>Newsletter Builder - <?php echo CHtml::link('Create your Newsletter Here', array('create'), array('class'=>'blue'));?></h1>
 <div class="line"></div>
  <div class="postUpdateDate blue"> <strong>Newsletter #<?php echo $number?></strong> <?php if($model->date_updated){?>- <span>Last updated <?php echo CommonClass::formatDate($model->date_updated,'l, d F Y \a\t H:i'); ?></span><?php }?> </div>
  <!--postUpdateDate-->
  <div class="subnav floatLeft">
    <ul class="nav nav-pills input-append">
      <li class="<?php echo (Yii::app()->controller->action->id=='details')?'selected':'';?>"><?php if($model)echo CHtml::link('Newsletter Details', array('details', 'nid'=>$model->id ), array('class' =>'btn')); else echo CHtml::link('Newsletter Details', array('#'),array('class' =>'btn'));?></li>
      <li class="<?php echo (Yii::app()->controller->action->id=='items')?'selected':'';?>"><?php if($model)echo CHtml::link('Included Items', array('items', 'nid'=>$model->id), array('class' =>'btn'));  else echo CHtml::link('Included Items', array('#'), array('class' =>'btn'));?></li>
      <li class="<?php echo (Yii::app()->controller->action->id=='lists')?'selected':'';?>"><?php if($model)echo CHtml::link('Mailing Lists', array('lists', 'nid'=>$model->id), array('class' =>'btn'));  else echo CHtml::link('Mailing Lists', array('#'), array('class' =>'btn'));?></li>
      <li class="<?php echo (Yii::app()->controller->action->id=='testnewsletter')?'selected':'';?>"><?php if($model) echo CHtml::link('Test', array('testnewsletter', 'nid'=>$model->id), array('class' =>'btn'));  else echo CHtml::link('Test', array('#'), array('class' =>'btn'));?></li>
      <li class="<?php echo (Yii::app()->controller->action->id=='preview')?'selected':'';?>"><?php if($model) echo CHtml::link('Preview', array('preview', 'nid'=>$model->id), array('class' =>'btn'));  else echo CHtml::link('Preview', array('#'), array('class' =>'btn'));?></li>
    </ul>
  </div>
  <div class="clear"></div>
  <?php 
  if(Yii::app()->controller->action->id=='create' || Yii::app()->controller->action->id=='details')
  {
  ?>
  <div class="line"></div>
  <h1>Newsletter Details - <span class="blue">Subject, Post Date and Details - (Required)</span></h1>
  <div class="line"></div>
  <?php 
  }
  if(Yii::app()->controller->action->id=='items')
  {
    ?>
    <div class="line"></div>
    <h1>Included Items - <span class="blue">Include Items with your newsletter</span></h1>
    <div class="line"></div>
    <?php
    
  }
  if(Yii::app()->controller->action->id=='preview')
  {
    ?>
    <div class="line"></div>
    <h1>Preview Newsletter - <span class="blue">Click link below to view newsletter in new window</span></h1>
    <div class="line"></div>
    <?php
  }
  if(Yii::app()->controller->action->id=='testnewsletter')
  {
    ?>
    <div class="line"></div>
    <h1>Test Newsletter - <span class="blue">Enter e-mail address below to test the newsletter </span></h1>
    <div class="line"></div>
    <?php
  }
  ?>
  <div class="seperator"></div>