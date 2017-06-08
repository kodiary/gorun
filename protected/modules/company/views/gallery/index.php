<div class="body_content_left">
<div class="restaurant_menus_wrapper">
    <h2>Gallery - <span>Use this to share photos or images - MAX 25 photos</span></h2>
    <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
    <div class="line"></div>
         <div id="showmsg"></div>
            <?php if(!$data){?>
                <div class="green-border">
                    <div class="fl_left">
                        <img src="<?php echo $this->createUrl('/images/alert.png')?>" alt="alert"/>
                    </div>
                    <div class="fl_right">
                        <div class="blue"><strong>Add photos to your gallery! (Max 25)</strong></div>
                        <div>A picture is worth a 1000 words and will help to create the impact you are looking for. Add photos of work you have completed, your company or team. Let the world know who you are. Add photos now using the form on the right.</div>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php }?> 
         <div class="img_gallery_lists">
           <ul id="sortable" class="ui-sortable">
            <?php $this->renderPartial('application.modules.admin.views.gallery._view',array('data'=>$data))?>
            </ul>
            <div class="clear" ></div>
          </div>
    </div>
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id'=>'cropModal',
        'options'=>array(
            'width'=>'auto',
            'height'=>'auto',
            'autoOpen'=>false,
            'resizable'=>false,
            'modal'=>true,
            'overlay'=>array(
                'backgroundColor'=>'#000',
                'opacity'=>'0.5'
            ),
            'close'=>"js:function(e,ui){ // to overcome multiple submission problem
                $('#cropModal').empty();
            }",
        ),
    ));
    //modal dialog content here
    
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
</div>
<div class="body_content_right" style="margin-top: 40px;">
 <div class="line mar-bot-10"></div>
    <?php echo $this->renderPartial('application.modules.admin.views.gallery._addImage',array('model'=>$model)); ?>

</div>
<div class="clear"></div>
<script type="text/javascript">
  $(document).ready(function() {
    $("#sortable").sortable({
      update : function () {
		  var order = $('#sortable').sortable('serialize');
  		 $("#showmsg").load("<?php echo $this->createUrl('sortImage');?>",order); 
      }
    });
    $('a.close').live('click',function(){
        $('div.alert').hide();
    });
});
</script>