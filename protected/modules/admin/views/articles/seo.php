<aside class="leftContainer floatLeft addArticles">
<div class="line"></div>
<?php $this->renderPartial('_articlesmenu');?>
  <div class="line"></div>
  <div class="subTitle">
    <h2>Seo - <span class="blue">Search Engine Optimisation</span></h2>
  </div>
  <!--subTitle-->
  <div class="line"></div>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'articleSeo-form',
));?>
<div class="addContentArea addSEO mar-bot-10">
<div class=" border-line mar-bot-10" >
<p><strong>Title </strong>- <span class="green">Most search engines use a maximum of 60 chars for title</span></p>
<p>You have <span id="count_left1">160</span> characters left</p>
</div>
<?php echo $form->textField($model, 'seo_title', array('class'=>'text_area_long') );?>

<div class="border-line" style="margin-bottom:10px">
<p><strong>Description</strong> - <span class="green">Most search engines use a maximum of 160 chars for description</span></p>
<p>You have <span id="count_left">160</span> characters left</p>
</div>
<?php echo $form->textArea($model, 'seo_desc' ,array('class'=>'text_area_long'));?>

<div class="border-line" style="margin-bottom:10px"><p><strong>Keywords </strong>- <span class="green">Input up to 8 keywords below that describe this article. (Optional)</span></p>
<p>Separate them with a comma Eg: keyword, keyword, keyword</p>
</div>
<?php echo $form->textArea($model, 'keywords',array('class'=>'text_area_long'));?>
</div><!--addcontetnarea-->

<div class="greybg"><?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-primary btn-large','style'=>'margin-left:120px;'));?></div>
<?php $this->endWidget();?>
</aside>
<!--addArticles-->

<aside class="rightContainer floatRight">
  <?php 
  if(isset($_GET['id'])) {
    $this->renderPartial('_social'); 
  }
  ?>
</aside>
<!--rigtCOntainer-->
<div class="clear"></div>
<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.noble.min.js');
?>
<script type="text/javascript">
jQuery(function($){
    $('#Articles_seo_desc').NobleCount('#count_left',{
        max_chars:160,
        block_negative: true
    });
    $('#Articles_seo_title').NobleCount('#count_left1',{
        max_chars:60,
        block_negative: true
    });
});
</script>