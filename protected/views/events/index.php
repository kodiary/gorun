<div class="sidebar col-md-3">
          <?php echo $this->renderPartial('/sidebar/_menu', false, true); ?>
        </div>
        <div class="col-md-9 right-content profile_detail"> 
            <div class="row">
            	<div class="col-md-8">
	                <h1 class="capital">Your events</h1>
	                <span class="">Manage the events you created.</span>
                </div>
                <div class="col-md-4">
                	<a href="<?php echo Yii::app()->request->baseUrl; ?>/events/create/0" class="btn btn-primary pull-right mt15">Add New Event</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <hr />
            <?php echo $this->renderPartial('/events/_listing', array('model'=>$dataProvider)); ?>
            
        </div>
        <div class="clearfix"></div>
        