
<div class="sidebar col-md-3">
          <?php echo $this->renderPartial('application.views.sidebar._menu', false, true); ?>
        </div>
        <div class="col-md-9 right-content profile_detail">
            
                <h1>ADD YOUR CLUB</h1>
                <span>
                    Add your club details below. You can edit these details at any time.<br />
                    Please note this is subject to approval before being posted live.
                </span>
            
            <div class="clearfix"></div>
            
            <hr />
            
            <?php echo $this->renderPartial('_form',array('member'=>$member,'events'=>$events));?>
            
        </div>
        <div class="clearfix"></div>
