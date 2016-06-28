<div class="titleBox<?php if(!(Events::rand2Events())){?> marginbot5<?php }?>"><h2>Upcoming Events</h2> <a href="<?php echo $this->createUrl('/events')?>">View More</a>
<div class="clear"></div>
</div>
<?php if($events = Events::rand2Events()){
    foreach($events as $data){
    $imagefile = Events::get1ImageFromFile($data->id);
    if($imagefile->title)
    $alt = $imagefile->title;
    else
    $alt = $data->title;
    ?>
    
<article class="relatedArticlesEvents">
<figure class="articleImage floatLeft">
  <a href="<?php echo $this->createUrl('events/'.$data->slug)?>" class="thumbnail"><span><?php echo Events::Image($imagefile->filename, 'thumb', $alt);?></span></a>
  </figure>
  <!--articleImage-->
  <aside class="articleContent floatRight">
      <h1><?php echo CHtml::link($data->title,$this->createUrl('events/'.$data->slug));?></h1>
      <span class="green f14">
      <span class="floatLeft"><img src="<?php echo Yii::app()->baseUrl.'/images/admin/calender.png'; ?>"  alt="Calender"/></span>
      <span class="floatRight"> <?php echo CommonClass::formatDate($data->start_date, 'l, d F Y');?> <br />
<?php echo $data->start_time?><?php if($data->end_time) echo ' to '.$data->end_time;?></span></span>
      
      
      </aside>

  <!--articleContent-->
  <div class="clear"></div>
</article>
<?php }}?>
