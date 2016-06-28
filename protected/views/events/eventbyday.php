<?php
$this->breadcrumbs=array(
	'events'=>array('index'),
    CommonClass::formatDate($_GET['day'])
);?>
<aside class="leftContainer floatLeft articles">
	<h1>Events of <?php echo CommonClass::formatDate($_GET['day']);?></h1>
     <div class="clear"></div>
 <div class="seperator"></div>
<?php 
if($dataProvider){
    foreach($dataProvider as $data){?>
    
<?php $imagefile = Events::get1ImageFromFile($data->id)?><div class="items">
<article>
  <figure class="articleImage floatLeft"><a href="<?php echo $this->createUrl('events/'.$data->slug)?>" class="thumbnail"><?php echo Events::Image($imagefile->filename, 'thumb', $imagefile->title);?></a></figure>
  <!--articleImage-->
  <aside class="articleContent floatRight">
    <aside class="articleDetail floatLeft">
      <h2><?php echo CHtml::link($data->title,$this->createUrl('events/'.$data->slug));?></h2>
      <p class="desc"><?php echo CommonClass::limit_text($data->detail,200);?></p>
      <span class="postedDate green f16"><img src="<?php echo Yii::app()->baseUrl.'/images/admin/calender.png'; ?>"  alt="Video"/> <?php echo CommonClass::formatDate($data->start_date, 'l, d F Y');?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <span class="green dateTime f16"><?php if($data->start_time){?><img src="<?php echo Yii::app()->baseUrl.'/images/admin/clock.png'; ?>"  alt="Video"/> <?php echo $data->start_time; }?><?php if($data->end_time) echo ' to '.$data->end_time;?></span></aside>
    <!--articleDetail-->
    
    <!--articleBUttons-->
    <div class="clear"></div>
  </aside>
  <!--articleContent-->
  <div class="clear"></div>
</article>


</div>
<?php }}else echo "<div>No event found.</div>";?>
<?php $this->renderPartial('/site/_bottomBanner');?>
</aside>
<aside class="rightContainer floatRight">
<?php $this->widget('ext.simple-calendar.SimpleCalendarWidget'); ?>
<?php $this->renderPartial('/site/_squareBanner');?>
</aside>
<div class="clear"></div>
