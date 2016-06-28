<script type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if ($('#'+limitField).val().length > limitNum) {
		$('#'+limitField).val($('#'+limitField).val().substring(0, limitNum));
	} else {
		limitCount.value = limitNum - $('#'+limitField).val().length;
	}
}
</script>

<!--<div class="subTitle">
  <h2>Add/Edit Page</h2>
</div>-->

<div class="addContentArea">
  <?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'contents-form',
    'type'=>'horizontal',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
  <ul>
  <li><?php //echo $form->errorSummary($model);?></li>
    <li class="mar-bot-10"><?php echo $form->label($model,'Parent Page'); ?>
     <?php echo $form->dropDownList($model, 'parent', CHtml::listData(Contents::model()->findAll(
        array(
        'select'=>'title,id',
        'condition'=>'parent=:parentID',
        'params'=>array(':parentID'=>'0'),
        )), 'id', 'title'),array('empty'=>'Select Parent Page','class'=>'span4')); ?>
      <div class="clear"></div>
    </li>
    <li class="mar-bot-10"> <?php echo $form->labelEx($model,'title'); ?> <?php echo $form->textField($model,'title',array('class'=>'titleBox span5','maxlength'=>60,'id'=>'page_title_text')); ?><?php echo $form->error($model,'title'); ?>
      <div class="clear"></div>
      <div class="seperator"></div>
    </li>

    <li class="mar-bot-10">
        <?php echo $form->labelEx($model,'Page Content <span class="required">*</span>'); ?>
        <div class="clear"></div>
        <?php $this->renderPartial('application.modules.admin.views.common.editor',array('model'=>$model,'attribute'=>'desc')); ?>
        <?php echo $form->error($model,'desc'); ?>
    </li>

    <?php if($model->id == 5){ ?>
    <li class="mar-bot-10">
        <div class="greybg mar-bot-10">Google Map Code</div>
        <?php $this->renderPartial('application.modules.admin.views.common.autotextarea'); ?>
        <?php echo $form->textArea($model,'google_map',array('class'=>'span7 autotextarea')); ?>
        <div class="clear"></div>
    </li>
    
    <li class="greybg radioOption mar-bot-10">
      <?php echo $form->radioButtonListRow($model, 'display_map', array(1=>'Yes', 0=>'No')); ?>
      <div class="clear"></div>
    </li>
    
    <li class="greybg radioOption mar-bot-10">
      <?php echo $form->radioButtonListRow($model, 'display_form', array(1=>'Yes', 0=>'No'));?>
      <div class="clear"></div>
    </li>
    <?php } ?>
    
    <li class="addSEO">
      <div class="greybg mar-bot-10">
        <p><strong> Title</strong> - </b><span class="green">Most search engine use a maximum of 60 chars for title</span></p>
        <p>
          You have <input readonly type="text" name="countdown1" id="countsss1" size="4" style="background:none; border:0; padding:0; margin:0; text-align:center; border-radius:none; width:30px; box-shadow:none; display: inline;" value="60" />
          characters left.</p>
      </div>
      <script type="text/javascript">
    /* INPUT page title VALUE TO meta title ON page title KEYUP*/
    $("#page_title_text").keyup(function() {
        $("#meta_title_text").val($("#page_title_text").val());
    })
</script> 
      <?php echo $form->textField($model,'meta_title',array('class'=>'fullTextbx text_area_long span7 mar-bot-10','size'=>65,'id'=>'meta_title_text', 'onKeyDown'=>'limitText("meta_title_text",this.form.countdown1,65)','onKeyUp'=>'limitText("meta_title_text",this.form.countdown1,65)')); ?> <?php echo $form->error($model,'meta_title'); ?>
      <div class="clear"></div>
    </li>
    <li class="addSEO" >
      <div class="greybg mar-bot-10">
        <p><strong>Description</strong> - </b><span class="green">Most search engine use a maximum of 160 chars for description</span></p>
        <p>You have
          <input readonly type="text" name="countdown" id="countsss" style="background:none; border:0; padding:0; margin:0; text-align:center; border-radius:none; width:30px; box-shadow:none; display: inline;" value="160" />
          characters left</p>
      </div>
      <?php echo $form->textArea($model,'meta_desc',array('class'=>'fullTextbx text_area_long mar-bot-10','size'=>160,'id'=>'repl_17', 'onKeyDown'=>'limitText("repl_17",this.form.countdown,160)','onKeyUp'=>'limitText("repl_17",this.form.countdown,160)')); ?> <?php echo $form->error($model,'meta_desc'); ?>
      <div class="clear"></div>
    </li>
    <li class="addSEO">
      <div class="greybg mar-bot-10">
        <p ><strong>Keywords</strong> - <span class="green">Input upto 8 keywords below that describe this article (Optional)</span>
        
        <p>Seperate them with the comma Eg: keyword, keyword, keyword</p>
      </div>
      <?php echo $form->textField($model,'meta_keywords',array('class'=>'fullTextbx text_area_long mar-bot-10','size'=>200)); ?> <?php echo $form->error($model,'meta_keywords'); ?>
      <div class="clear"></div>
    </li>
    <li class="greybg radioOption mar-bot-10">
      <?php //<label> Visibility </label>?>
      <?php echo $form->radioButtonListRow($model, 'status', array(
        1=>'Publish live',
        0=>'Draft Mode (Hidden)')
        ); ?> <?php //echo $form->error($model,'status'); ?>
      <div class="clear"></div>
    </li>
    <li class="greybg">
      <?php 
        $p_id=Contents::model()->findByPk($model->id);
        //echo CHtml::activeHiddenField($model,'p_id',array('value'=>$p_id));
        ?>
      <div class="floatLeft" style="margin-left: 120px;">
        <?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
            'size' =>'large',
			'label'=>'Submit',
		));?>
      </div>
      <?php if(!in_array($model->id,array(1,2,3,4,5))){?>
      <div class="floatRight">
        <?php if(isset($editContent) && $editContent=='1'){ ?>
        <?php                
				$del_url = Yii::app()->createUrl('/admin/contents/delete/id/'.$model->id."_".$p_id->parent);
					$this->widget('bootstrap.widgets.BootButton', array(
					'buttonType'=>'delete',
					'type'=>'danger',
					'size' =>'normal',
					//'url' => $del_url,
					'label'=>'Delete',
					'htmlOptions'=>array('id'=>'delete_'.$model->id,
					'onClick'=>'$("#show_'.$model->id.'").show(400);'),
				)); 
					?>
        <?php }//end for checking new creation page?>
      </div>
      <?php }?>
      <div class="clear"></div>
    </li>
  </ul>
  <div style="display: none;" id="show_<?php echo $model->id?>" class="alert">
    <div class="floatLeft margintop5"> Warning: This cannot be undone. Are you sure? </div>
    <div class="floatRight">
      <?php 
            $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'danger',
            'size' =>'normal',
            'url' => $del_url,
			'label'=>'Delete',
        ));?>
      <?php
            $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'cancel',
			'type'=>'normal',
            'size' =>'normal',
			'label'=>'Cancel',
            'htmlOptions'=>array('id'=>'delete_'.$model->id,            
            'onClick'=>'$("#show_'.$model->id.'").hide(400);'),            
		));?>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<?php $this->endWidget(); ?>