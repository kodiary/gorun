<div class="col-md-8">
    <div class="line"></div>
    <h1>Resources - <span class="blue">Manage resources documents here</span></h1>
    <div class="line"></div>
    <?php $this->widget('bootstrap.widgets.BootAlert'); ?>        
    
    <?php
    
    if($model)
    {
        foreach($model as $resource)
        {
            $categoryModel = ResourceCategory::getCategoryByResource($resource->cat_id);
            if($categoryModel){ ?>
                <div class="new-greybg"><?php echo $categoryModel->title; ?></div>
                <?php
                $resourceModel = Resources::getResourceByCategory($resource->cat_id);
                if($resourceModel)
                {
                    foreach($resourceModel as $res)
                    {
                        $this->renderPartial('_view',array('data'=>$res));                        
                    }    
                }
            }
        }
    }
    ?>
<div class="clear"></div>
</div><!--#col-md-8-->

<div class="col-md-4">
  <div class="mar-bot-10">
      <?php
        $this->widget('bootstrap.widgets.BootButton', array(
            //'fn'=>'ajaxLink',
            'url' => array('create'),
            'label'=>'+Add Resource',
            'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            //'size'=>'small', // '', 'small' or 'large'
        ));
      ?>
  </div>
</div><!--#col-md-4-->
<div class="clear"></div>