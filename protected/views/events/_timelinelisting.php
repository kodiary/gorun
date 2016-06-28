<?php if($eventsModel){ ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/timeline.js"></script>
    <?php 
        if(isset(Yii::app()->session['timelineDate']) && Yii::app()->session['timelineDate']!=''){
            $prev_monthyear = Yii::app()->session['timelineDate'];
        }
        else{
            $prev_monthyear = '';
        }
        if(isset($index) && $index!='') $i= $index;
        else $i=1;
        
        foreach($eventsModel as $model){
            $i++;
            $offset = $i;
            if(isset($model->start_date) && $model->start_date!='0000-00-00') $curr_monthyear = CommonClass::formatDate($model->start_date, 'F Y');
            if($curr_monthyear != $prev_monthyear){?>
                <div class="date-hidden">abc</div>
                <div class="date-new"><?php echo $curr_monthyear; ?></div>
                <div class="date-hidden">abc</div>
                
            <?php }
            $prev_monthyear = $curr_monthyear;
            $this->renderPartial('_timelineview',array('data'=>$model,'index'=>$offset));
        }
        Yii::app()->session['timelineDate'] = $prev_monthyear;
    ?>
<?php }?>