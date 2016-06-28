<?php $this->renderPartial('/company/_companyHeader',array('model'=>$cmodel));?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="company-bottom"> 
<div class="left_body">
<div class="restaurant_menus_wrapper">

<h2>Gallery - <span>Use this to share photos or images - MAX 25 photos</span></h2>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
 <div id="showmsg"></div>
 <div class="img_gallery_lists">
   <ul id="sortable" class="ui-sortable">
    <?php $this->renderPartial('_view',array('data'=>$data))?>
    </ul>
    <div class="clear" ></div>
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
</div>

<div class="right_body">
   <div>
    <?php echo $this->renderPartial('_addImage',array('model'=>$model)); ?>
    </div>
</div>
<div class="clear"></div>
</div>
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
