<div class="sidebar col-md-3">
          <?php echo $this->renderPartial('/common/_clubs', false, true); ?>
        </div>
        <div class="col-md-9 right-content items">
            <?php
            $this->breadcrumbs=array(
        	$type." clubs",
        );
        $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
            'htmlOptions'=>['style'=>'background:#fff; border:1px solid #ccc; margin-bottom:10px;']
        ));
        
        ?>
        
            <h2><?php echo ucfirst($type);?> Clubs, All Provinces</h2>
            <?php
             $this->widget('CLinkPager', array(
            'pages' => $pages,
            'htmlOptions'=>['style'=>'display:none'],
        ));
            foreach($dataProvider as $club){
                
                ?>
            <div class="listing">
                <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/events/noimg.png"/></div>
                <div class="txt">
                    <h3><?php echo $club->title;?></h3>
                    <span class="datetime"><?php echo $club->venue;?></span> 
                    <span class="racetag"><?php echo $club->province;?></span>
                    <div class="clearfix"></div>
                    <?php 
                    $types = explode(',',substr($club->types, 0 ,(strlen($club->types)-1)));
                    foreach($types as $type)
                    {?>
                        <span class="distance"><?php echo $type;?></span>    
                    <?php
                    }?>
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <?php }
            if($pages->itemCount>Yii::app()->params['articles_pers_page'])
            echo "<a href='javascript:void(0);' class='btn btn-primary' id='load_more'>Load More</a>";
            ?>
            
        </div>
        <div class="clearfix"></div>
<script>
$(function(){
    var curPage = 1;
    var pagesNum = $("li.page:last").text();
    //$('#load_more').attr('href',$('li.next a:first').attr('href'));
    //alert($('li.next a:first').attr('href'));
    $('.items').infinitescroll({
 
    navSelector  : "ul.yiiPager",            
                   // selector for the paged navigation (it will be hidden)
    nextSelector : "li.next a:first",    
                   // selector for the NEXT link (to page 2)
    itemSelector : ".items div.listing",          
                   // selector for all items you'll retrieve
    //debug        : true,
    //donetext     : "I think we've hit the end, Jim" ,
  }, function() {  // Optional callback when new content is successfully loaded

            curPage++;

            if(curPage == pagesNum) {

                $(window).unbind('.infscr');
                $('#load_more').remove();
            }
            });
  $(window).unbind('.infscr');
  $('a#load_more').click(function(){
        
        $('.items').infinitescroll('retrieve');
      //$(window).trigger('retrieve.infscr');
      
      return false;
    });
    
   
   $(document).ajaxError(function(e,xhr,opt){
      if (xhr.status == 404)
      {
        $('#load_more').remove();
      }
      
      
    });
});

</script>
