  <div class="subTitle">
    <h2>Video - <span class="blue">Include YouTube video with your news - (Optional)</span></h2>
  </div>
  <!--subTitle-->
  <div class="line"></div>

<div class="addContentArea addVideo">
    <ul class="video-lists">
        <?php if(!$model_video->isNewRecord){
            foreach($model_video as $i=>$model){
                $this->renderPartial('_addvideo', array(
    				'model' => $model,
    				'index' => $i,
    			));            
            }
        } ?>
	</ul>
</div><!--addContentArea-->

<?php echo CHtml::button('+Add Video', array('class' => 'btn video-add'))?>

<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
    $(".video-add").click(function(){
        var counter=$(".video-lists li").size(); 
        if(counter<=0){
            counter = 50;
            var count = counter;
        }else{
            var last = $(".video-lists li[id^=remove_video_]:last").attr("id");
            var count = last.split('_')[2];
            count++;
        }
        $(".video-add").val('loading...');
        $.ajax({
        	success: function(html){
        		$(".video-lists").append(html);
        	},
            complete: function(){
                 $(".video-add").val('+Add Video');
            },
        	type: 'get',
        	url: '<?php echo $this->createUrl('addVideoField')?>',
        	data: {index: count},
        	cache: false,
        	dataType: 'html'
        });
    });
});
</script>