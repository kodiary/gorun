<div class="clearfix"></div>
<div class="searchblock" style="<?php if($past==1){}else{?>display: none;<?php }?>;">
    <div class="filter2 whitetext col-md-7">
        <span>Results</span> &nbsp; | &nbsp; 
        <?php
                    //var_dump($m_time);
                    $i=0;
                    foreach($m_time as $mt)
                    {
                        $i++;
                        ?>
                        <a href="javascript:void(0)" class="dis <?php if($i==1){?>dis_active<?php }?>" id="<?php if($i==1)$ajax_id = $mt->id; echo $mt->id;?>">
                        <?php
                        if($mt->distance1){
                            ?>
                           
                        <?php echo $mt->distance1?>,<?php echo $mt->distance2?>km 
                        <?php
                        }
                        ?>
                        <?php
                        if($mt->distance_swim_1){
                            ?>
                        
                            <strong>Triathlon </strong><?php echo $mt->distance_run_1?>, <?php echo $mt->distance_run_2?>km / <?php echo $mt->distance_bike_1?>, <?php echo $mt->distance_bike_2?>km / <?php echo $mt->distance_swim_1?>, <?php echo $mt->distance_swim_2?>km 
                        
                        <?php
                        }
                        ?>
                        
                        
                        </a><?php if($i!=count($m_time)){?> &nbsp; | &nbsp; <?php }?>
                        <?php
                    }
                    ?>
    </div>
    
    <div class="col-md-5">
        <input type="text" class="search_name" placeholder="Search Name" /> <input type="button" value="GO" class="btn search_results results btnresult"/>
    </div>
    <div class="clearfix"></div>
</div>
<div class="col-md-12 content" style="display: none;">
    
            
            <div class="results_body">
                <table class="table">
                    <tbody>
                    </tbody>
                </table>
                
            </div>
        
</div>
<script>
$(function(){
    loadBoard('<?php echo $ajax_id;?>');
    $('.dis').live('click',function(){
        loadBoard($(this).attr('id'));
    });
})
function loadBoard(id)
{
    $('.results_body .table tbody').html('<tr><td colspan="5"><center style="margin-top:10px;"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/ajax-loader.gif" /></center></td></tr>');
    
    var event_time_id = id;
    $.ajax({
        url:'<?php echo Yii::app()->request->baseUrl;?>/events/loadBoard',
        data:'event_time_id='+id,
        type:'post',
        success:function(res){
            $('.results_body .table tbody').html(res);
        }
    })
}
</script>