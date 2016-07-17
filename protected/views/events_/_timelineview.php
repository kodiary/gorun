<div class="block timeline-list" id="timeline-<?php echo $index;?>">
    <span id="edge"></span>
    <?php 
        if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$data->logo) && $data->logo)
            $imagefile = Yii::app()->baseUrl.'/images/frontend/thumb/'.$data->logo;
        else
            $imagefile = Yii::app()->request->baseUrl."/images/events_fallback_thumb.png";
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
    
    <div class="thumbnail left">
        <a href="<?php echo $this->createUrl('events/'.$data->slug)?>" ><img src="<?php echo $imagefile;?>" /></a>
    </div>
    
    <div class="desc">
          <h2><?php echo CHtml::link($data->title,$this->createUrl('events/'.$data->slug));?></h2>
          <span class="postedDate green f16">
            <?php echo (($data->start_date==$data->end_date && $data->start_date!='0000-00-00')?(CommonClass::formatDate($data->start_date, 'd F')):''); ?>
            <?php 
                if($data->start_date!=$data->end_date && $data->start_date!="0000-00-00" && $data->end_date!="0000-00-00"){
                    if(CommonClass::formatDate($data->start_date, 'F')==CommonClass::formatDate($data->end_date, 'F')){
                        echo CommonClass::formatDate($data->start_date, 'd')."-".CommonClass::formatDate($data->end_date, 'd F, Y');
                    }
                    else{
                        echo CommonClass::formatDate($data->start_date, 'd F')." - ".CommonClass::formatDate($data->end_date, 'd F, Y');
                    }
                }
            ?>
          </span>
          <p><?php echo $venue_location;?></p>
    </div> 
    <div class="clear"></div>        
</div>
