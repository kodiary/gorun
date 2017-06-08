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
        <h1 class="detail_heading"><?php echo ucfirst($model->title);?><br />
            <span class="blue"><?php echo $model->town.", ".Province::model()->getTitle($model->province);?></span></h1>
        
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
            <h3 class="mem_count"><span><?php echo $total;?> MEMBER<?php if($total>1)echo 'S';?></span></h3>
            <div class="icons follow_icons">
                <a href="<?php echo $model->fb_page;?>" target="_blank">
                    <span class="fa fa-facebook"></span>
                </a>
                <a href="<?php echo $model->twitter_page;?>" target="_blank">
                    <span class="fa fa-twitter"></span>
                </a>
                <a href="<?php echo $model->google;?>" target="_blank">
                    <span class="fa fa-google-plus"></span>
                </a>
            </div>
            <div class="activities" style="margin-bottom:10px;">
            <h3><strong>CLUB ACTIVITES</strong></h3>
            <?php 
           
            $activities = explode(',',$model->types);
            foreach($activities as $activity)
            {
                if($activity!='')
                {
                    echo EventsType::model()->titleName($activity)."<br/>";
                }
            }?>
            
            </div>
            <div class="clearfix"></div>
            <div class="contact" style="height: 40px;margin-bottom:10px;">
                <a href="mailto:<?php echo $model->contact_email;?>?Subject=Hello" target="_top" class="btn-submit"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;CONTACT CLUB</a>
            </div>
           
            <div class="phone_number">
        
                    <h1><?php echo ($model->contact_number);?></h1>
       
            </div>
        </div>
        <div class="col-md-8">
            <div class="padding-left-10">
                <div class="social_share">
                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                    <div class="addthis_inline_share_toolbox"></div>
                    
                </div>
                <?php echo $model->description;?>
                <div class="website"><a href="<?php echo $model->website;?>" target="_blank"><?php echo strtoupper(str_replace('http://','',$model->website));?></a></div>
                
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="map col-md-12 block_border toggle-div" style="margin:0;border-bottom:none">
        <a href="javascript:void(0)" onclick="toggle_div('map_more',this);"><span><strong>LOCATION</strong></span>
        <span class="right"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
    </div>
    <div class="clearfix"></div>
    <div class="cold-md-12 map_more block_border" >
        <div class="form-group">
            <?php echo $model->venue.",".$model->town;?>
        </div>
     <?php 
        if($model->latitude!=0 && $model->longitude!=0)
        {
        ?>
        <?php $this->renderPartial('_map',array('model'=>$model));?>
        <div>
            <span class="blue"><a href="http://www.google.com/maps/place/<?php echo $model->latitude.",".$model->longitude;?>"  target="_blank">VIEW ON GOOGLE MAPS</a></span>
        
        </div>
        <?php }?>
        
    </div>
    
    <div class="col-md-12 block_border toggle-div" <?php if(count($model->member)==0)echo 'style="margin:0;border-bottom:none"';?>>
        <a href="javascript:void(0)" onclick="toggle_div('members_more',this);"><span><strong><?php  if($total!=0)echo $total;?> MEMBER<?php if($total>1||$total==0)echo 'S';?></strong></span>
        <span class="right"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
    </div>
    <div class="clearfix"></div>
    <div class="members_more">
    <?php
    $criteriaCM = new CDbCriteria;
    $criteriaCM->with = ['member'];
    $criteriaCM->condition = 'club_id = :club_id';
    $criteriaCM->params = ['club_id'=> $model->id];
    $criteriaCM->order = 'member.fname';
    $clubMemberCount = ClubMember::model()->count($criteriaCM);
    $criteriaCM->limit = Yii::app()->params['articles_pers_page'];
    $clubMembers = ClubMember::model()->findAll($criteriaCM);
    if(count($clubMembers)>0)
    {
        $this->renderPartial('/common/_memberBlock',['models'=>$clubMembers,'offset'=>Yii::app()->params['articles_pers_page']]);
        
    }
    
    else
        echo "<div class='block_border blue'>No Resluts</div>";
    ?>
    <div class="clearfix"></div> 
    </div>
    <?php
        if($clubMemberCount> Yii::app()->params['articles_pers_page'])
            echo "<a href='javascript:void(0);' onclick='load_content(\"members_more\");' class='btn btn-loadmore membersloadmore'>Load More</a>";
    ?>
    <div class="col-md-12 block_border toggle-div" >
        <a href="javascript:void(0)" onclick="toggle_div('admin_more',this);"><span><strong>ADMINS</strong></span>
        <span class="right"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
    </div>
    <div class="clearfix"></div>
    <div class="admin_more">
        
      <div class="white" style="width: 49%;float:left;margin-bottom:15px;border-radius:5px;">
        
            <?php
            $admin = Member::model()->findByPk($model->created_by);
                if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$admin->logo)&&$admin->logo!='')
                {
                    $img_url=Yii::app()->baseUrl.'/images/frontend/thumb/'.$admin->logo;
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
                <div class="Members_name"><?php echo ucfirst($admin->fname." ".$admin->lname);?></div>
                <span class="results"><?php echo EventResult::model()->resultCountbyUser($admin->id);?> Results</span>
                <div class="blue race-reviews"><?php echo Review::model()->resultCountbyUser($admin->id);?> RACE REVIEWS</div>
            </div>
            <div class="clearfix"></div>
        
        </div>   
        
    </div>
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
    <div class="news col-md-12 block_border toggle-div" <?php if(!$dataProvider)echo 'style="margin:0;border-bottom:none"';?>>
        <a href="javascript:void(0)" onclick="toggle_div('results_more',this);"><span><strong>CLUB LEADERBOARD</strong></span>
        <span class="right"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
    </div>
    <div class="clearfix"></div>
    <div class="cold-md-12 results_more">
    <?php
    $id = '';
        $clubMembers = ClubMember::model()->findAllByAttributes(['club_id'=>$model->id]);
        foreach($clubMembers as $member)
        {
            $ids[] = $member->member_id;
            $id.= $member->member_id.",";
        }
        
        $criteria = new CDbCriteria;
        //$criteria->select = '*,( SELECT MIN(dist_time) AS mini FROM tbl_event_result GROUP BY event_type ,distance) AS m';
        //$criteria->with = ['member'];
        
        $id = substr($id,0,(strlen($id)-1));
        //$criteria->select = '*';
        $criteria->addInCondition('user_id',$ids);
        //$criteria->condition = 'member.fname LIKE "%w%"';
        $criteria->group = 't.event_type, t.distance';
        $criteria->together = true;
        //var_dump($criteria);
        //$results = Yii::app()->db->createCommand('SELECT distance,dist_time,event_type FROM tbl_event_result AS a, (SELECT MIN(dist_time) AS mini FROM tbl_event_result GROUP BY event_type ,distance, user_id ) AS m WHERE m.mini = a.dist_time AND a.user_id in('.$id.') ORDER BY a.event_type ASC, a.dist_time, a.distance ')->queryAll();
        
        $results = EventResult::model()->findAll($criteria);
        
        $this->renderPartial('/common/_board',['results'=>$results,'ids'=>$id]);
        
    ?>
    </div>
    <div class="clearfix"></div>
  
            
            
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
    var offset = $('.'+div+' > .white').last().attr('title');
    $.ajax({
        url:"<?php echo Yii::app()->baseUrl;?>/member/loadmore/model/ClubMember/offset/"+offset+"/view/_memberBlock",
        type: "post",
        dataType: 'html',
        data: <?php echo json_encode($criteriaCM);?>,
        success:function(msg){
            $('.'+div).append(msg);
            var n_offset = $('.'+div+' > .white').last().attr('title');
            if(Number(<?php echo $clubMemberCount;?>) <= Number(n_offset))
                $('.membersloadmore').hide();
        }
        
    });
}

</script>

          
