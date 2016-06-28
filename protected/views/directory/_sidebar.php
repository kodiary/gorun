<!-- gallery -->
<div class="marginTop10">
<?php
if($gallery)
{
    
    $count=0;
    //Create an instance of ColorBox
    $colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
     
    //Call addInstance (chainable) from the widget generated.
    $colorbox->addInstance('a[rel="galleryView"]');
          
    ?>
    <ul class="gallery_sidebar_grid">
    <?php
    foreach($gallery as $image)
    {
       $count++;
       $image_name=$image->name;
       if($image_name!="") 
        {
           if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$image_name))
            {

              $image_url = Yii::app()->baseUrl."/images/frontend/thumb/".$image_name; 
              $main_image = Yii::app()->baseUrl."/images/frontend/full/".$image_name;
              if($image->caption!="") $caption = $image->caption;
              else $caption = $name." Image ".$count;
       ?>
       <li>
       <a class="z" href="<?php echo $main_image;?>" rel="galleryView" title="<?php echo $image->caption;?>">
       <img class="thumbnail" width="60" height="60" src="<?php echo $image_url;?>" alt="<?php echo $caption;?>"/>
       </a>
       </li>
       <?php
            } 
        } 
    }
    ?>
    <div class="clear"></div>
    </ul>
    <?php
}
 ?>
</div>
<!-- gallery end -->
<!-- trading hours -->
<?php echo $this->renderPartial('_tradingHours',array('model'=>$model,'tradingHours'=>$tradingHours));?>
<!-- trading hours end-->
<!-- popup box for google doc--> 
<?php $this->renderPartial('/site/_googledocpopup');?>
<!-- google doc end-->

<?php
if($jobs)
{
?>
    <div class="round blue_block">
    	<h2><span class="bold">Jobs</span> at this company</h2>
    </div>  
    <ul id="job">
    <?php foreach($jobs as $job)
    {
      ?>
        <li id="<?php echo $job->id?>">
        <div class="title"><?php echo ucwords($job->title);?></div>
        <div class="desc">
            <div id="short_<?php echo $job->id;?>" class="spDtails">
                <p>
                    <?php echo CommonClass::limit_text(strip_tags($job->desc),130);?>
                    <a href="javascript:void(0);" class="jbexpand" id="expand_<?php echo $job->id;?>"><strong>Read More</strong></a>
                </p>
            </div>
            <div id="long_<?php echo $job->id;?>" class="jbexpanded readMore spDtails" style="display: none;">
                <p><?php echo $job->desc;?></p>
            </div>
        </div>
        </li>
        <div class="clear"></div>
      <?php  
    } 
    ?>
    </ul>
<?php 
}
?>