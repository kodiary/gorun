<div class="sidebar col-md-3">
    <?php echo $this->renderPartial('/sidebar/_menu', false, true); ?>
</div>
<div class="col-md-9 right-content profile_detail">
<?php
    $this->breadcrumbs=array('clubs',
	$model->province,$model->title,
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'htmlOptions'=>['style'=>'background:#fff; border:1px solid #ccc; margin-bottom:10px;']
));

?>
    <div class="col-md-12 block_border">
        <h1><?php echo $model->title;?></h1>
        <strong><span class="blue"><?php echo $model->province.", ".$model->town;?></span> </strong>
        <div class="wallpaper" style=" background: #0af none repeat scroll 0 0;
            height: 200px;
            margin-bottom: 10px;
            width: 100%">
        </div>
        <div class="col-md-4" style="position: relative;  top: -122px; left:15px;text-align: center;">
            <div class="club_img" >
             <?php
                if(file_exists(Yii::app()->basePath.'/../images/clubs/thumb/'.$model->logo))
                {
                    $img_url=Yii::app()->baseUrl.'/images/clubs/thumb/'.$model->logo;
                }
                else
                {
                    $img_url=Yii::app()->baseUrl.'/images/noimage.jpg';    
                }
             ?>
                <img src="<?php echo $img_url;?>"/>
                
             </div>
             <div class="clearfix"></div>
            <a href="" class="btn btn-primary col-md-12">Follow +</a>
            <h3><strong><?php echo $total;?> MEMBERS</strong></h3>
            <div class="icons">
            
            </div>
            <div class="activities">
            <h3><strong>CLUB ACTIVITES</strong></h3>
            <?php $activities = explode(',',$model->types);
            foreach($activities as $activity)
            {
                echo $activity."<br/>";
            }?>
            </div>
            <div class="contact block_border">
            <a href="#"><i class="fa fa-envelope-o"></i> CONTACT CLUB</a>
            </div>
            <div class="phone">
            <?php
                foreach($model->extras as $extra)
                {
                    if($extra->type=='contact_number'){
            ?>
                    <strong><?php echo ($extra->value);?></strong>
            <?php
                    }
                }
            ?>
            
            </div>
        </div>
        <div class="col-md-8">
        <?php echo $model->description;?>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="news col-md-12 block_border">
        <a href="javascript:void(0)" onclick="$('.news_more').toggle();"><span><strong>NEWS</strong></span>
        <span class="right"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
    </div>
    <div class="clearfix"></div>
    <div class="cold-md-12 news_more" >
   
    <?php if(!$dataProvider->getData()){?>
        <div class="green-border">
            <div class="left">
                <img src="<?php echo $this->createUrl('/images/alert.png')?>" alt="alert"/>
            </div>
            <div class="right">
                <div class="blue"><strong>Share your News with the world</strong></div>
                <div>Now you can publish all your news to the world right from your listing. Once you post your news, we will review it and post it live for all to you. Add news now using the button on the right.</div>
            </div>
            <div class="clear"></div>
        </div>
    <?php }else{ ?>          
    <?php
        $this->widget('bootstrap.widgets.BootListView',array(
        	'dataProvider'=>$dataProvider,
        	'itemView'=>'/site/_articles',
            'summaryText'=>'',
        ));    
    ?>
    <?php } ?>

    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 block_border">
        <a href="javascript:void(0)" onclick="$('.news_more').toggle();"><span><strong>MEMBERS</strong></span>
        <span class="right"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
    </div>
    <div class="clearfix"></div>
    <div class="members_more">
    <?php
    foreach($model->member as $member)
    {
    ?>
        <div class="block_border col-md-6">
        <?php
                if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$member->logo)&&$member->logo!='')
                {
                    $img_url=Yii::app()->baseUrl.'/images/frontend/thumb/'.$member->logo;
                }
                else
                {
                    $img_url=Yii::app()->baseUrl.'/images/noimage.jpg';    
                }
             ?>
            <div class="col-md-3">
                <img class="img-circle" src="<?php echo $img_url;?>"/>
            </div>
            <div class="col-md-9">
                <?php echo ucfirst($member->fname." ".$member->lname);?>
            </div>
            
        </div>   
    <?php
    }
    ?>
    </div>
    <div class="col-md-12 block_border">
        <a href="javascript:void(0)" onclick="$('.news_more').toggle();"><span><strong>ADMINS</strong></span>
        <span class="right"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
    </div>
  
            
            
</div>
<div class="clearfix"></div>

