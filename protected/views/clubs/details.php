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
    <div class="col-md-12" style="background: #fff; border:1px solid #ccc;">
        <h1><?php echo $model->title;?></h1>
        <strong><span class="blue"><?php echo $model->province.", ".$model->town;?></span> </strong>
        <div class="wallpaper" style=" background: #0af none repeat scroll 0 0;
    height: 200px;
    margin-bottom: 10px;
    width: 100%">
    </div>
    <div class="club_img" style="position: relative;  top: -122px; left:45px">
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
        <a href="" class="btn btn-primary col-md-12">Follow +</a>
        <span><?php echo $total_member;?> Members</span>
        
    </div>
    </div>
    
  
            
            
</div>
<div class="clearfix"></div>

