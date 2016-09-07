<div class="sidebar col-md-3">
    <?php echo $this->renderPartial('/common/_clubs', ['prov_id'=>$model->province], true); ?>
</div>
<div class="col-md-9 right-content profile_detail">
<?php
    $this->breadcrumbs=array('clubs',
	Province::model()->getTitle($model->province),$model->title,
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'htmlOptions'=>['style'=>'background:#fff; border:1px solid #ccc; margin-bottom:10px;','class'=>'bcrumb']
));

?>
    <div class="col-md-12 block_border detail_page">
        <h1 class="detail_heading"><?php echo ucfirst($model->title);?><br /><span class="blue"><?php echo Province::model()->getTitle($model->province).", ".$model->town;?></span></h1>
        
        <div class="wallpaper" style="">
        </div>
        <div class="col-md-4" style="position: relative;  top: -100px; left:15px;text-align: center;">
            <div class="club_img" style="margin-bottom: 5px;border:1px solid #eee;width:auto;height: auto;" >
             <?php
                if(file_exists(Yii::app()->basePath.'/../images/clubs/thumb/'.$model->logo)&&$model->logo!='')
                {
                    $img_url=Yii::app()->baseUrl.'/images/clubs/thumb/'.$model->logo;
                }
                else
                {
                    $img_url=Yii::app()->baseUrl.'/images/no_logo.jpg';    
                }
             ?>
                <img src="<?php echo $img_url;?>"/>
                
             </div>
             <div class="clearfix"></div>
             <?php
             if(Yii::app()->user->isGuest || !$ismember)
             {?>
                <a href="javascript:void(0);" class="btn btn-follow <?php if(!$ismember)echo "followclub";?>" <?php if(Yii::app()->user->isGuest){?> data-target="#loginModal" data-toggle="modal"<?php }?>>Follow +</a>
            <?php }?>
            <h3 class="mem_count"><span><?php echo $total;?> MEMBERS</span></h3>
            <div class="icons follow_icons">
                <a href="#">
                    <span class="fa fa-facebook"></span>
                </a>
                <a href="#">
                    <span class="fa fa-twitter"></span>
                </a>
                <a href="#">
                    <span class="fa fa-google-plus"></span>
                </a>
            </div>
            <div class="activities">
            <h3><strong>CLUB ACTIVITES</strong></h3>
            <?php $activities = explode(',',$model->types);
            foreach($activities as $activity)
            {
                echo $activity."<br/>";
            }?>
            </div>
            
            <div class="contact" style="height: 40px;">
            <a href="#" class="btn-submit" style="border: 2px solid #878787;color: #878787;font-size: 16px;"><i class="fa fa-envelope-o"></i> CONTACT CLUB</a>
            </div>
            <div class="clearfix"></div>
            <div class="phone_number">
            <?php
                foreach($model->extras as $extra)
                {
                    if($extra->type=='contact_number'){
            ?>
                    <?php echo ($extra->value);?>
            <?php
                    }
                }
            ?>
            
            </div>
        </div>
        <div class="col-md-8">
            <div class="padding-left-10">
                <div class="sharing">
                    <a href="#" class="btn-facebook"><span class="fa fa-facebook"></span> Share on facebook</a>
                    <a href="#" class="btn-twitter"><span class="fa fa-twitter"></span> Share on twitter</a>
                    <a href="#" class="btn-plus"></a>
                    <span class="total_share">667 Shares</span>
                    <div class="clearfix"></div>
                </div>
                <?php echo $model->description;?>
                <div class="website"><a href="<?php echo $model->website;?>" target="_blank"><?php echo strtoupper(str_replace('http://','',$model->website));?></a></div>
                 <?php 
                if($model->latitude!=0 && $model->longitude!=0)
                {
                ?>
                <?php $this->renderPartial('_map',array('model'=>$model));?>
                <div>
                    <span class="blue"><strong>ADDRESS -</strong></span> <a href="http://www.google.com/maps/place/<?php echo $model->latitude.",".$model->longitude;?>" class="red" target="_blank">View on Google Maps</a>
                
                </div>
                <?php }?>
                <div class="venue_detail">
                    <?php echo $model->venue;?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="news col-md-12 block_border toggle-div" <?php if(!$dataProvider)echo 'style="margin:0;border-bottom:none"';?>>
        <a href="javascript:void(0)" onclick="toggle_div('news_more',this);"><span><strong>NEWS</strong></span>
        <span class="right"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
    </div>
    <div class="clearfix"></div>
    <div class="cold-md-12 news_more" >
   
    <?php if(!$dataProvider){?>
        <!--div class="green-border">
            <div class="left">
                <img src="<?php echo $this->createUrl('/images/alert.png')?>" alt="alert"/>
            </div>
            <div class="right">
                <div class="blue"><strong>Share your News with the world</strong></div>
                <div>Now you can publish all your news to the world right from your listing. Once you post your news, we will review it and post it live for all to you. Add news now using the button on the right.</div>
            </div>
            <div class="clear"></div>
        </div-->
        <div class="block_border blue"> No Results!</div>
    <?php }else{
       
       $this->widget('CLinkPager', array(
            'pages' => $pages,
            'htmlOptions'=>['style'=>'display:none'],
        ));
         /* auto scrolling on showall
    if($pages->itemCount>Yii::app()->params['items_pers_page'])
        $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
        'contentSelector' => '.items',
        'itemSelector' => '.direcotry_listing',
        'loadingText' => 'Loading...',
        'donetext' => 'There are no more news.',
        'pages' => $pages,
    ));*/
    
    ?>
            
        <?php
        $this->renderPartial('/site/_articles',['dataProvider'=>$dataProvider]);
           /* $this->widget('bootstrap.widgets.BootListView',array(
            	'dataProvider'=>$dataProvider,
            	'itemView'=>'/site/_article_old',
                'summaryText'=>'',
            ));   */
         if($pages->itemCount>Yii::app()->params['articles_pers_page'])
            echo "<a href='javascript:void(0);' class='btn btn-loadmore' id='load_more'>Load More</a>";
        ?>
        <?php } ?>
    
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 block_border toggle-div" <?php if(count($model->member)==0)echo 'style="margin:0;border-bottom:none"';?>>
        <a href="javascript:void(0)" onclick="toggle_div('members_more',this);"><span><strong>MEMBERS</strong></span>
        <span class="right"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
    </div>
    <div class="clearfix"></div>
    <div class="members_more">
    <?php
    if(count($model->member)>0)
    {
        $i=0;
        foreach($model->member as $member)
        {
            $i++;
        ?>
            <div class="white" style="width: 49%;float:<?php if($i%2==1){?>left<?php }else{?>right<?php }?>;margin-bottom:15px;border-radius:5px;">
            
            <?php
                    if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$member->logo)&&$member->logo!='')
                    {
                        $img_url=Yii::app()->baseUrl.'/images/frontend/thumb/'.$member->logo;
                    }
                    else
                    {
                        $img_url=Yii::app()->baseUrl.'/images/blue.png';    
                    }
                 ?>
                <div class="col-md-3">
                    <img class="img-circle" src="<?php echo $img_url;?>"/>
                </div>
                <div class="col-md-9">
                    <div class="Members_name"><?php echo ucfirst($member->fname." ".$member->lname);?></div>
                    <span class="results">5 Results</span>
                    <div class="blue race-reviews">23 RACE REVIEWS</div>
                </div>
                <div class="clearfix"></div>
            
            </div>
            
        <?php
        }
        
        //echo "<a href='javascript:void(0);' onclick='load_content(\"members_more\");' class='btn btn-loadmore'>Load More</a>";
        
    }
    
    else
        echo "<div class='block_border blue'>No Resluts</div>";
    ?>
    <div class="clearfix"></div> 
    </div>
    <div class="col-md-12 block_border toggle-div" <?php if(true)echo 'style="margin:0;border-bottom:none"';?>>
        <a href="javascript:void(0)" onclick="toggle_div('admin_more',this);"><span><strong>ADMINS</strong></span>
        <span class="right"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
    </div>
    <div class="clearfix"></div>
    <div class="admin_more">
        <div class="block_border blue">No Results</div>
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
    itemSelector : ".items div.directory_listing",          
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
    
    $('.followclub').click(function(){
        $.ajax({
            type:'post',
            url:'<?php echo Yii::app()->request->baseUrl;?>/clubs/follow',
            data:'club_id=<?php echo $model->id;?>',
            success:function(msg){
                if(msg=='OK')
                    window.location.href ="<?php echo Yii::app()->request->url; ?>";
            }
        })
    })
})
function toggle_div(div,thi)
{
    var clas;
    $('.'+div).toggle();
    if($('.'+div).is(':visible'))
        clas = 'glyphicon glyphicon-chevron-down';
    else
    {
        clas = 'glyphicon glyphicon-chevron-up';
        $(thi).parent().css({'border-bottom':'1px solid #ccc;'});
        //$(thi).parent().attr('style','margin-bottom:10px;');
    }
        
    $(thi).find('.right>i').attr('class',clas);
}
function load_content(div)
{
    alert($('.'+div).attr('class'));
}

</script>
