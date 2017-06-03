
<div class="sidebar col-md-3">
          <?php echo $this->renderPartial('/site/_filter', false, true); ?>
        </div>
        <div class="col-md-9 right-content">
            <?php echo $this->renderPartial('/events/_listing', array('model'=>$events)); ?>
            
        </div>
        <div class="clearfix"></div>