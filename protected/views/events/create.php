<div class="sidebar col-md-3">
          <?php echo $this->renderPartial('/sidebar/_menu', false, true); ?>
        </div>
        <div class="col-md-9 right-content profile_detail"> 
            
                <h1 class="capital">Your event details</h1>
                <span class="">Enter your event details below. You can edit your event details at any time.<br />Please note that this is subject to approval before being posted live.</span>
            
            <hr />
            <?php echo $this->renderPartial('/events/_form', array('model'=>$model,'event_type'=>$event_type)); ?>
            
        </div>
        <div class="clearfix"></div>