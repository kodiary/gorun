<div class="sidebar col-md-3">
  <?php echo $this->renderPartial('/sidebar/_menu', false, true); ?>
</div>
<div class="col-md-9 right-content profile_detail"> 
    <div class="row">
    	<div class="col-md-8">
            <h1 class="capital">Events Attending</h1>
            <span class="">All your events that you showed intrest in attending.</span>
        </div>
        <div class="col-md-4">
        	
        </div>
        <div class="clearfix"></div>
    </div>
    <hr />
    <?php echo $this->renderPartial('/events/_listing', array('model'=>$dataProvider)); ?>
    
</div>
<div class="clearfix"></div>
