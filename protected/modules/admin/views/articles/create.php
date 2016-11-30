<?php
if(isset($_GET['id']) && $_GET['id']!='')
{
    $model = Articles::model()->findByPk($_GET['id']);
    $number=$model->number;
}
else
{
    $number=Articles::findmaxnumber()+1;
}
?>
<aside class="col-md-8 floatLeft addArticles">
<div class="line"></div>
  <h1>Add/Edit News - <a href="#">Create or Edit an Article Here</a></h1>
  <div class="line"></div>

  <div class="postUpdateDate blue"><strong>Article #<?php echo $number?></strong></div>
  <!--postUpdateDate-->
  <div class="subnav">
    <ul class="nav nav-pills input-append">
        <?php
        $action =  $this->action->id;
        $action2 = $action;  
        if($action != 'create')
        {
            $action2 = 'update';
        }  
        ?>
        <li <?php if($action == 'create')echo " class='selected'";?>><?php if(isset($_GET['id'])) echo CHtml::link('Article Details', array($action, 'id'=>$model->id)); else echo CHtml::link('Article Details','#',array( 'class'=>'btn'));?></li>
        <li <?php if($action == 'addphotos')echo " class='selected'";?>><?php if(isset($_GET['id'])) echo CHtml::link('Photos/Images', array('addphotos', 'id'=>$model->id)); else echo CHtml::link('Photos/Images','#',array( 'class'=>'btn'));?></li>
        <li <?php if($action == 'addaudio')echo " class='selected'";?>><?php if(isset($_GET['id'])) echo CHtml::link('Audio', array('addaudio', 'id'=>$model->id)); else echo CHtml::link('Audio','#',array( 'class'=>'btn'));?></li>
        <li <?php if($action == 'addvideo')echo " class='selected'";?>><?php if(isset($_GET['id'])) echo CHtml::link('Video', array('addvideo', 'id'=>$model->id)); else echo CHtml::link('Video','#',array( 'class'=>'btn'));?></li>
        <li <?php if($action == 'adddoc')echo " class='selected'";?>><?php if(isset($_GET['id'])) echo CHtml::link('Documents', array('adddoc', 'id'=>$model->id)); else echo CHtml::link('Documents','#',array( 'class'=>'btn'));?></li>
        <li <?php if($action == 'comments')echo " class='selected'";?>><?php if(isset($_GET['id'])) echo CHtml::link('Comments', array('comments', 'id'=>$model->id)); else echo CHtml::link('Comments','#',array( 'class'=>'btn'));?></li>
        <li <?php if($action == 'seo')echo " class='selected'";?>><?php if(isset($_GET['id'])) echo CHtml::link('SEO', array('seo', 'id'=>$model->id)); else echo CHtml::link('SEO','#',array( 'class'=>'btn'));?></li>
        <li <?php if($action == 'preview')echo " class='selected'";?>><?php if(isset($_GET['id'])) echo CHtml::link('Preview', array('preview', 'id'=>$model->id)); else echo CHtml::link('Preview','#',array( 'class'=>'btn'));?></li>
    </ul>
  </div>
  <div class="line"></div>
  <div class="subTitle">
    <h2>Article Details - <span class="blue">Title, Post Date and Details - (Required)</span></h2>
  </div>
  <!--subTitle-->
  <div class="line"></div>
  <?php
    //Yii::app()->clientScript->registerCoreScript('jquery.ui');
    echo $this->renderPartial('_form', array('model'=>$model, 'model_source'=>$model_source));
    //echo $this->renderPartial('_addimage');
  ?>
</aside>
<!--addArticles-->

<aside class="col-md-4 floatRight"></aside>
<!--rigtCOntainer-->
<div class="clear"></div>
