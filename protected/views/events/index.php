<div class="sidebar col-md-3">
          <?php echo $this->renderPartial('/sidebar/_menu', false, true); ?>
        </div>
        <div class="col-md-9 right-content profile_detail"> 
            
                <h1 class="capital">Your events</h1>
                <span class="">Enter your event details below. You can edit your event details at any time.<br />Please note that this is subject to approval before being posted live.</span>
            
            <hr />
            <?php echo $this->renderPartial('/events/_listing', array('model'=>$dataProvider)); ?>
            
        </div>
        <div class="clearfix"></div>
        