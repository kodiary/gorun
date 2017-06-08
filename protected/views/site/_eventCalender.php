<?php
    $event_model = Events::getActiveEvents();
    if($event_model){
?>
<div class="home-events-new">
    <div class="header-new">
        <div class="fl_left">EVENT CALENDER</div>
        <div class="fl_right"><a href="<?php echo $this->createUrl('/events'); ?>">View More</a></div>
        <div class="clear"></div>
    </div>
    
    <?php foreach($event_model as $model){ ?>
        <div class="events-box">
            <div class="fl_left">
            	<a class="thumbnail left" href="<?php echo $this->createUrl('events/'.$model->slug);?>">
                    <?php
                        $baseUrl = Yii::app()->baseUrl;
                        $basePath = Yii::app()->basePath;
                        $img_url = $baseUrl.'/images/events_fallback_thumb.png';
                        $alt = $model->title;
                    
                        $filename=$model->logo;
                        //get aritlce image if article image exists
                        if(file_exists($basePath.'/../images/frontend/thumb/'.$filename) && $filename!="")
                            $img_url=$baseUrl.'/images/frontend/thumb/'.$filename;
                
                        echo  CHtml::image($img_url, $alt);  
                    ?>
                </a>
             </div>
             <div class="fl_right desc">
                 <div class="date"><?php echo date('d F Y',strtotime($model->start_date))?></div>
                <div class="title"><a href="<?php echo $this->createUrl('events/'.$model->slug);?>"><?php echo ucfirst($model->title)?></a></div>
               
                <div class="venue">
                    <?php
                    if($model->venue_id=="0")
                    {
                        $venue=Venues::model()->findByAttributes(array('event_id'=>$model->id));
                        $venue_location=$venue->title.", ".$venue->address;
                    }
                    else
                    {
                        $venue=Company::model()->findByPk($model->venue_id);
                        $venue_location=$venue->name;
                    }
                    echo $venue_location
                    ?>                    
                </div>
            </div>
            <div class="clear"></div>
            
        </div>
    <?php } ?>
    
    <div class="more-new"><a href="<?php echo $this->createUrl('/events'); ?>">MORE <i class="icon-circle-arrow-right"></i></a></div>
</div>
<div class="clear"></div>
<?php } ?>