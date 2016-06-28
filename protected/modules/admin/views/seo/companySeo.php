    <div class="left_body">
        <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
        <?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
        	'id'=>'seo-form',
            'type'=>'horizontal',
        	'enableAjaxValidation'=>false,
            'htmlOptions'=>array('id'=>'frmSeo'),
        )); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/selectbox/jquery.selectBox.min.js"));?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/selectbox/jquery.selectBox.css"));?>
        <script type="text/javascript">
        	$(document).ready( function() {
        	$("SELECT")
        	.selectBox()
        	});
        </script>
        <div class="seo_form_wraps">
        <div class="line"></div>
        <h1 class="admin_top_list_headings">Edit Company SEO</h1>
        <div class="line"></div>
        <p><?php echo $form->dropDownList($model,'id',Company::getAll(), array('empty'=>'Select Company','onchange'=>"$('#frmSeo').submit();")); ?></p>
        <div class="line"></div>
        	<?php echo $form->textFieldRow($model,'seo_title',array('class'=>'span5','maxlength'=>255)); ?>
            <div class="justify">Title of page - always followed by generic SEO</div>
        
        	<?php echo $form->textAreaRow($model,'seo_desc',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>
            <div class="justify">160 Character descrption</div>
        	<?php echo $form->textFieldRow($model,'seo_keywords',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>
            <div class="justify">Separated by comma - eg food, drink, dine</div>
        	<div class="greybg">
            <div style="margin-left:70px;">
        		<?php $this->widget('bootstrap.widgets.BootButton', array(
        			'buttonType'=>'submit',
        			'type'=>'primary',
        			'label'=>'Save',
                    'htmlOptions'=>array('name'=>'btnSubmit','id'=>'submitBtn')
        		)); ?>
        	</div>
            </div>
        </div>
        
        <?php $this->endWidget(); ?>
    </div>
	<div class="right_body">
    	<div class="right_btns">
            <?php $this->renderPartial('_bypage'); ?>
        </div>
    </div>
<div class="clear"></div>

<script type="text/javascript">
// <![CDATA[
$(document).ready(function(){
    var id=$('#Company_id').val();
    if(id==''){
        $('#Company_seo_title').attr("disabled", "disabled");
        $('#Company_seo_desc').attr("disabled", "disabled"); 
        $('#Company_seo_keywords').attr("disabled", "disabled");
        $('#submitBtn').attr("disabled", "disabled");
    }
    else{
        $('#Company_seo_title').removeAttr("disabled"); 
        $('#Company_seo_desc').removeAttr("disabled"); 
        $('#Company_seo_keywords').removeAttr("disabled");
        $('#submitBtn').removeAttr("disabled");
    }
});
/*]]>*/   
</script>