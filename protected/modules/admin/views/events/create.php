        <div class="row">
            <div class="col-md-10 mt15">
                <?php echo $this->renderPartial('/events/_form', array('model'=>$model,'event_type'=>$event_type,'is_admin'=>$is_admin)); ?>
                
            </div>
            <div class="clearfix"></div>
        </div>