<div class="block_border" style="padding: 0;">
<div class="results col-md-12" style="border-radius: 0;">
    <div class="filter2 col-md-4">
        <div class="fil-group" style="position: relative;">
        <a href="javascript:void(0)" class="fil ResulteventType" title="<?php echo $results[0]->event_type."_".$results[0]->distance;?>"><?php echo $results[0]->type['title']."-".$results[0]->distance."Km";?><span class="fa fa-sort"></span></a>
        <ul class="option" style="padding: 0px; list-style: outside none none; position:absolute; bottom:-100px; width:100%">
        <?php  
        
        foreach($results as $k=>$result)
        {
        ?>
            <li><a href="javascript:void(0);" title="<?php echo $result->event_type."_".$result->distance;?>"><?php echo $result->type['title']." - ".$result->distance."Km";?></a></li>
        <?php
        }
        ?>
        
        </ul>
        </div>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-5">
        <input type="text" class="search_name" placeholder="Search Name" /> <input type="button" value="GO" class="btn search_results results"/>
    </div>
    <div class="clearfix"></div>
</div>
<div class="results_body">
</div>
</div>
<script>
$(function(){
    var events = $(".ResulteventType").attr('title').split('_');
    var datas= {
        'event_type':events[0],
        'distance': events[1],
        'searchname': $('.search_name').val(),
        'ids':'<?php echo $ids;?>'};
    $('.option >li').click(function(){
        var title = $(this).find('a').attr('title');
        $('.ResulteventType').attr('title',title);
    })
  
    $.ajax({
        type: "post",
        url: "<?php echo Yii::app()->request->baseUrl;?>/clubs/getresults",
        data: datas,
        dataType: 'html',
        success:function(msg){
            $('.results_body').html(msg);
        }
       }) 
    $('.search_results').click(function(){
        
        events = $(".ResulteventType").attr('title').split('_');
        datas= {
        'event_type':events[0],
        'distance': events[1],
        'searchname': $('.search_name').val(),
        'ids':'<?php echo $ids;?>'};
       $.ajax({
        type: "post",
        url: "<?php echo Yii::app()->request->baseUrl;?>/clubs/getresults",
        data: datas,
         success:function(msg){
            $('.results_body').html(msg);
        }
       }) 
    });
})
</script>