<aside class="col-md-8">
<div class="line"></div>
<h2>Patron Members - <span class="blue">Add/Edit Patron Members logos here</span></h2>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?> 
<div id="showmsg"></div>
<div class="restaurant_menus_wrapper">
<?php echo $this->renderPartial('_addImage');?>
<?php if($images){
        foreach($images as $image){
         echo CHtml::image(Yii::app()->baseUrl.'/images/frontend/main/'.$image->ImageName);
         echo CHtml::ajaxLink('Delete', array('delete', 'id'=>$image->id), array('replace'=>'#thumb_image'));}   
        }
        else{?>
        <div id="thumbDiv"></div>
        <div id="cropDiv" style="display:none"><?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Crop', 'htmlOptions'=>array('id'=>'cropButton'))); ?></div>
        <?php }?>
        
        <?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	       'id'=>'patronslider-form',
            //'enableClientValidation'=>true,
            'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>false),
        ));?>
    <ul class="images" id="sort_slide">
		<?php for($i=0; $i<count($modelImages); $i++):?>
			<?php $this->renderPartial('_view', array(
				'modelImages' => $modelImages[$i],
			));?>
        <?php endfor ?>
	</ul>
    <div class="light-blue-bg  mar-bot-10 radioOption flo-new">
        <?php echo $form->radioButtonListRow($modelSetting, 'visible', array('1'=>'Publish Live', '0'=>'Draft Mode (Hidden)'));?>
        <div class="clear"></div>
    </div>
    <div class="greybg">
    <div style="margin-left:120px;">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'size'=>'large', // '', 'large', 'small' or 'mini'
			'type'=>'primary',
			'label'=>'Submit'
	));?>
    </div>
     </div>
</div><!--addContentArea-->        
        <?php $this->endWidget(); ?>

</aside><!--leftCOntainer-->
<aside class="col-md-4">
<?php echo CHtml::button('+Add Slide', array('class' => 'btn image-add'));?>
</aside><!--rightCOntainer-->
<div class="clear"></div>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'cropModal',
    'options'=>array(
        'width'=>'auto',
        'height'=>'auto',
        'autoOpen'=>false,
        'resizable'=>false,
        'modal'=>true,
        'overlay'=>array(
            'backgroundColor'=>'#fff',
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


<script type="text/javascript">
   $(function(){
    
     var pattern = new RegExp('^(https?:\/\/)?'+ // protocol
    '((([a-z\d]([a-z\d-]*[a-z\d])*)\.)+[a-z]{2,}|'+ // domain name
    '((\d{1,3}\.){3}\d{1,3}))'+ // OR ip (v4) address
    '(\:\d+)?(\/[-a-z\d%_.~+]*)*'); /*+ // port and path
    '(\?[;&a-z\d%_.~+=-]*)?'+ // query string
    '(\#[-a-z\d_]*)?$','i'); // fragment locater*/
    
    //$(".alert").slideUp(2000);
    $("#sort_slide").sortable({
       update : function () {
            $('#showmsg').show();
    		var order = $('#sort_slide').sortable('serialize');
           	$("#showmsg").load("<?php echo $this->createUrl('sortslide');?>",order, function (){
  		       $(this).slideUp(5000);
  		    });
            
          }
        });
    
    $("#patronslider-form").submit(function(){
        var flag = true;
           $(".links").each(function(){
                var link_id = $(this).attr('id');
                var value = $(this).val();
                if(value!=''){
                      if(!pattern.test(value)) {
                            $(this).next('.linkError').html('Invalid URL!');
                            flag = false; 
                      }
                      else{
                            $(this).next('.linkError').html('');
                      }
                }
           });
        return flag;
    });        
   
   });
</script>