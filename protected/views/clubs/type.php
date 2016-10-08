<div class="sidebar col-md-3">
          <?php echo $this->renderPartial('/common/_clubs', ['prov_id'=>$province_id,'type'=>$type], true); ?>
        </div>
        <div class="col-md-9 right-content ">
        <div class="items ">
            <?php
            if(isset($province_id))
            {
                $province = Province::model()->getTitle($province_id);
                $bread = array($type." clubs",$province);
            }
            else
               $bread = array($type." clubs");
            $this->breadcrumbs=$bread;
        $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
            'htmlOptions'=>['style'=>'background:#fff; border:1px solid #ccc; margin-bottom:10px;']
        ));
        
        ?>
        
            <h2><?php echo ucfirst($type);?> Clubs, <?php echo (isset($province_id))?$province:'All Provinces';?></h2>
            <?php
            if(count($dataProvider)>0){
             $this->widget('CLinkPager', array(
            'pages' => $pages,
            'htmlOptions'=>['style'=>'display:none'],
        ));
            foreach($dataProvider as $club){
                
                ?>
            <div class="listing">
                <div class="img">
                <?php
                    if(file_exists(Yii::app()->basePath.'/../images/clubs/thumb/'.$club->logo)&&$club->logo!='')
                    {
                        $img_url=Yii::app()->baseUrl.'/images/clubs/thumb/'.$club->logo;
                    }
                    else
                    {
                        $img_url=Yii::app()->baseUrl.'/images/noimage.jpg';    
                    }
                 ?>
                    <a href="<?php echo Yii::app()->baseUrl;?>/clubs/<?php echo $club->slug;?>"><img src="<?php echo $img_url; ?>" width="90" height="90"/></a>
                </div>
                <div class="txt">
                    <h3><?php echo $club->title;?></h3>
                    <span class="datetime"><?php echo $club->venue;?></span> 
                    <span class="racetag"><?php echo Province::model()->getAbbrivation($club->province);?></span>
                    <div class="clearfix"></div>
                    <?php 
                    $types = explode(',',substr($club->types, 0 ,(strlen($club->types)-1)));
                    foreach($types as $type)
                    {?>
                        <a href="<?php echo Yii::app()->baseUrl.'/clubs/type/'.str_replace(' ','_',$type);?>"><span class="distance"><?php echo $type;?></span></a>    
                    <?php
                    }?>
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <?php }
            
            }
            else
                echo "No Results Found.";
            ?>
            
       </div>
        <div class="form-group">
           <?php
        if($pages->itemCount>Yii::app()->params['articles_pers_page'])
            echo "<a href='javascript:void(0);' class='btn btn-primary' id='load_more'>Load More</a>";
        ?> 
        </div>
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
