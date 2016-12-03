<div class="results_table table">
    <table class="table result_table">
        <thead>
            <th><span class="blue">POS</span></th>
            <th><span class="">NAME</span></th>
            <th><span class="">DISTANCE</span></th>
            <th><span class="">AV PACE</span></th>
            <th><span class="">TIME</span></th>
            <th><span class="">DATE</span></th>
        </thead>
        <tbody class="more_results">
        <?php
            $this->renderPartial('/common/_trResult',['models'=>$results,'offset'=>$offset]);
        ?>
        </tbody>
      
    </table>
    <?php

if($count > Yii::app()->params['results_per'])
{
    echo "<a href='javascript:void(0);' class='btn btn-loadmore loadmoreResult' onclick='loadmore(\"more_results\");'>Load More</a>";
}
?>
</div>
<script>
    function loadmore(div){
        var offset = $('.'+div+' tr').last().attr('title');
        var pos = $('.'+div+' tr .pos').last().text();
        
        $.ajax({
            url:"<?php echo Yii::app()->baseUrl;?>/member/loadmore/model/EventResult/offset/"+offset+"/view/_trResult?pos="+pos,
            type: "post",
            dataType: 'html',
            data: <?php echo json_encode($criteria);?>,
            success:function(msg){
                $('.'+div).append(msg);
                var n_offset = $('.'+div+' tr').last().attr('title');
                if(Number(<?php echo $count;?>) <= Number(n_offset))
                    $('.loadmoreResult').hide();
            }
            
        });
    }
</script>
