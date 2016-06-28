<aside class="left_body floatLeft addArticles">
<div class="line"></div>
<?php 
    if($model->is_approved==0){?>
    <div style="background:#f2f2f2; margin-bottom:6px;" class="features_extra_01 border_line">
	<div class="left margintop5" style="width: 300px;"><span class="bold">APPROVAL</span></div>
    <div class="right" style="width: 200px;">
    
		 <?php $this->widget('bootstrap.widgets.BootButton', array(
                //'fn'=>'ajaxLink',
                'url' => array('approve', 'id'=>$model->id),
                'label'=>'Approve News',
                'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'small' or 'large'
                ));?>
    <?php $this->widget('bootstrap.widgets.BootButton', array(
                //'fn'=>'ajaxLink',
                'url' => array('reject', 'id'=>$model->id),
                'label'=>'Reject',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'small' or 'large'
                ));
                ?>	</div>
    <div class="clear"></div>
 </div>
<?php }?>

<?php $this->renderPartial('_articlesmenu');?>
  <div class="line"></div>
  <div class="subTitle">
    <h2>Article Details - <span class="blue">Title, Post Date and Details - (Required)</span></h2>
  </div>
  <!--subTitle-->
  <div class="line"></div>
  
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<?php echo $this->renderPartial('_form',array('model'=>$model, 'source'=>$source, 'model_source'=>$model_source));?>
<div><?php //echo $this->renderPartial('_addimage');?></div> 

</aside>
<!--addArticles-->

<aside class="right_body floatRight">
  <?php 
  if(isset($_GET['id'])) {
    $this->renderPartial('_social'); 
  }
  ?>
</aside>
<!--rigtCOntainer-->
<div class="clear"></div>