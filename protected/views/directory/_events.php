<div id="eventsInfo" style="display:none;">
<?php 
if($events)
{
    foreach($events as $data)
    {
      ?>
        <div class=" laout_5 directory_listing">

        <?php 
        
        if($data->logo)
        {
            $imagefile = Yii::app()->request->baseUrl."/images/frontend/thumb/".$data->logo;    
        }
        else
        {
            $imagefile = Yii::app()->request->baseUrl."/images/exhibition.png";
        }
        $venue_id=$data->venue_id;
        
        if($venue_id=="0")
        {
            $venue=Venues::model()->findByAttributes(array('event_id'=>$data->id));
            $venue_location=$venue->title.", ".$venue->address;
        }
        else
        {
            $venue=Company::model()->findByPk($venue_id);
            $venue_location=$venue->name;
        }
        ?>
        <div class="left thumbnail">
          <a href="<?php echo $this->createUrl('events/'.$data->slug)?>" ><img src="<?php echo $imagefile;?>" /></a>
        </div>
        
        
        <div class="texts_right">
              <h2><?php echo CHtml::link($data->title,$this->createUrl('events/'.$data->slug));?></h2>
              <span class="postedDate green f16"><?php echo CommonClass::formatDate($data->start_date, 'd F Y').(($data->start_date!=$data->end_date && $data->end_date!="0000-00-00")?(" - ".CommonClass::formatDate($data->end_date, 'd F Y')):"");?></span>
              <p><?php echo $venue_location;?></p>
        </div> 
        <div class="clear"></div>        
        </div>
      <?php  
    }  
}
else
{
    echo "No events added!";
}
?>
</div>