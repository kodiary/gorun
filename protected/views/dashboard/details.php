<div class="sidebar col-md-3">
    <?php echo $this->renderPartial('/common/_clubs', ['prov_id'=>$model->province], true); ?>
</div>
<div class="col-md-9 right-content profile_detail">
<?php
    $this->breadcrumbs=array($model->fname." ".$model->lname,
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'htmlOptions'=>['style'=>'background:#fff; border:1px solid #ccc; margin-bottom:10px;','class'=>'bcrumb']
));

?>
    <div class="col-md-12 block_border detail_page">
        <h1 class="detail_heading">
            <?php echo ucfirst($model->fname." ".$model->lname);?>
            <?php if(strtolower($model->fname.$model->lname)!=strtolower($model->username)){?>
            <label class="blue">"<?php echo ucfirst($model->username);?>"</label>
            <?php }?>
            <br />
            <span class="blue"><?php echo ($model->gender==1)?'Male ':"Female ";?><?php echo Member::model()->getAge($model->dob).", ".Province::model()->getTitle($model->province).", ".$model->suburb;?></span></h1>
        
        <div class="wallpaper">
            <?php
                if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$model->cover)&&$model->cover!='')
                {
                    $img_url=Yii::app()->baseUrl.'/images/frontend/thumb/'.$model->cover;
                }
                else
                {
                    $img_url=Yii::app()->baseUrl.'/images/no_img.jpg';    
                }
             ?>
             <img src="<?php echo $img_url;?>"/>
        </div>
        <div class="col-md-4" style="position: relative;  top: -100px; left:15px;text-align: center;">
            <div class="club_img img-circle" style="margin-bottom: 5px;border:1px solid #eee;width:auto;height: auto;" >
             <?php
                if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$model->logo)&&$model->logo!='')
                {
                    $img_url=Yii::app()->baseUrl.'/images/frontend/thumb/'.$model->logo;
                }
                else
                {
                    $img_url=Yii::app()->baseUrl.'/images/no_logo.jpg';    
                }
             ?>
                <img src="<?php echo $img_url;?>" class="img-circle"/>
                
             </div>
             <div class="clearfix"></div>
             <?php
               
             if(Yii::app()->user->isGuest || !$isfollowed)
             {?>
                <a href="javascript:void(0);" class="btn btn-follow <?php if(!$isfollowed)echo "followclub";?>" <?php if(Yii::app()->user->isGuest){?> data-target="#loginModal" data-toggle="modal"<?php }?>>Follow +</a>
            <?php }
            else
            {?>
                <a href="javascript:void(0);" class="btn btn-unfollow btn-inverse <?php if($isfollowed)echo "unfollow";?>" >Unfollow Athelete -</a>
            <?php    
            }?>
            <h3 class="mem_count form-group"><span><?php echo $total=125;?> ACTIVITIE<?php if($total>1)echo 'S';?></span></h3>
            <div class="contact form-group" style="height: 30px;">
            <a href="mailto:<?php echo $model->email;?>?Subject=Hello" target="_top" class="btn-submit" style="border: 2px solid #878787;color: #878787;font-size: 16px;"><i class="fa fa-envelope-o"></i> CONTACT ATHLETE</a>
            </div>
            <div class="icons follow_icons">
                <a href="<?php echo $model->facebook;?>" target="_blank">
                    <span class="fa fa-facebook"></span>
                </a>
                <a href="<?php echo $model->twitter;?>" target="_blank">
                    <span class="fa fa-twitter"></span>
                </a>
                <a href="<?php echo $model->google;?>" target="_blank">
                    <span class="fa fa-google-plus"></span>
                </a>
            </div>
            <?php
            if(count($clubs)> 0){?>
            <div class="activities">
                <h3><strong class="blue">MEMBER OF</strong></h3>
                <?php 
                
                foreach($clubs as $key=>$activity)
                {
                    
                    echo ucwords($activity['title']);
                    if($key+1!=count($clubs))
                    echo "<hr/>";
                }?>
            </div>
            <?php }?>
            
       
            <div class="clearfix"></div>
         
        </div>
        <div class="col-md-8">
            <div class="padding-left-10">
                    <div class="social_share">
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                <?php echo $model->detail;?>
                <span class="blue">
                    <strong>PERSONAL BESTS</strong><br/>
                </span>                    
                    <?php
                    foreach($results as $key=>$result)
                    {
                        if($key==0){
                                                        
                            echo "<span class='event_btn btn-inverse'>".strtoupper(EventsType::model()->titleName($result['event_type']))."</span><br/>";
                        }
                        elseif($result['event_type']!= $results[$key-1]['event_type'])
                        {
                            echo "<span class='event_btn btn-inverse'>".strtoupper(EventsType::model()->titleName($result['event_type']))."</span><br/>";
                        }                        
                        echo "<strong>".str_replace('.',',',$result['distance'])."K</strong> <span class='grey'>-</span> <span class='blue'>".$result['dist_time']."</span> <span class='grey'>- ".date('d M Y',$result['result_date'])."</span><br/>";
                    ?>
                           
                    <?php
                    }?>
              
                
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <?php 
    if(count($results)>0)
        $show = 1;
    foreach($events as $event)
    {
        //$dataProvider = EventResult::model()->findBy();
    ?>
        <div class="<?php echo str_replace(' ','',$event->title);?> col-md-12 block_border toggle-div" style="<?php if(!$dataProvider)echo 'margin:0;border-bottom:none';if(!isset($show))echo "display:none;"?>">
            <a href="javascript:void(0)" onclick="toggle_div('<?php echo str_replace(' ','',$event->title);?>_more',this);"><span><strong><?php echo $event->title;?></strong></span>
            <span class="right"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
        </div>
        <div class="clearfix"></div>
        <div class="cold-md-12 <?php echo str_replace(' ','',$event->title);?>_more" >
       
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
    <?php 
          
    }
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
        $(this).attr('disabled','disabled');
        $.ajax({
            type:'post',
            url:'<?php echo Yii::app()->request->baseUrl;?>/dashboard/follow',
            data:'follower_id=<?php echo $model->id;?>',
            success:function(msg){
                if(msg=='OK')
                    window.location.href ="<?php echo Yii::app()->request->url; ?>";
                else
                    $(this).removeAttr('disabled');
            }
        })
    })
     $('.unfollow').click(function(){
        $(this).attr('disabled','disabled');
        $.ajax({
            type:'post',
            url:'<?php echo Yii::app()->request->baseUrl;?>/dashboard/unfollow',
            data:'follower_id=<?php echo $model->id;?>',
            success:function(msg){
                if(msg=='OK')
                    window.location.href ="<?php echo Yii::app()->request->url; ?>";
                else
                    $(this).removeAttr('disabled');
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
