<?php
$this->breadcrumbs=array(
    'member directory'=>array('/directory'),
    strtolower($model->name),
);?>
<?php $this->renderPartial('_directoryHead',array('model'=>$model));?>
<div class="body_content_left">

<?php $this->renderPartial('_companyInfo', array('model'=>$model,'slug'=>$slug,'brochures'=>$brochures,'videos'=>$videos,'gallery'=>$gallery));?>
<?php $this->renderPartial('_about',array('model'=>$model,'id'=>$id, 'slug'=>$slug));?>
<?php $this->renderPartial('_brochures',array('brochures'=>$brochures));?>
<?php $this->renderPartial('_map',array('model'=>$model));?>
<?php $this->renderPartial('_video',array('videos'=>$videos));?>
<?php $this->renderPartial('_news',array('news'=>$news));?>
<?php //$this->renderPartial('_jobs',array('jobs'=>$jobs));?>
<?php $this->renderPartial('_events',array('events'=>$events));?>
<div id="infoTab">
    <div id="about">
    	<?php if($model->tagline!=""){?>
        <div class="line"></div>
        <h2 class="rockwell"><?php echo $model->tagline;?></h2>
        <div class="line"></div>
        <?php } ?>
      	<div class="description_taglines">
          <?php echo $model->detail; ?>
        </div>
        <?php 
          $services=$model->services;
          if($services)
          {
            ?>
            <div class="line"></div>
            <h2 class="rockwell">Our Services Include:</h2>
            <div class="line"></div>
            <?php
      
            foreach($services as $service)
            {
            ?>
            <li><?php echo ucwords(Services::model()->findByPk($service->service_id)->service_name);?></li>
            <?php
            }

          }
          ?>
    </div>
    <!-- about end -->
</div>

<div id="_info" style="display: none;">
    <?php //ajax update the tabs content here by hiding  the #about div ?>
</div>

<!-- bottom banner-->
<?php $this->renderPartial("/site/_bottomBanner");?>
</div>

<!-- right sidebar-->
<div class="body_content_right">
<?php $this->renderPartial('_sidebar', array('gallery'=>$gallery,'name'=>$model->name,'model'=>$model,'tradingHours'=>$tradingHours,'jobs'=>$jobs));?>

<!-- square banner-->
<?php $this->renderPartial("/site/_squareBanner");?>
</div>
<div class="clear"></div>
<!-- end right sidebar-->