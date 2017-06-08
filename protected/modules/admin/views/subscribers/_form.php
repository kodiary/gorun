<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'subscribers-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>true),
    
)); ?>

	<?php 
            echo $form->textFieldRow($model,'first_name',array('class'=>'span5','maxlength'=>255));
            echo $form->textFieldRow($model,'last_name',array('class'=>'span5','maxlength'=>255));
            echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255));
    ?>
    <div class="line"></div> 
    <?php
        $listing = array();
        if(!$model->isNewRecord)
        {
            $subscriber_on_list = SubscribersDetail::findBySubscriberId($model->id);
        
            foreach($subscriber_on_list as $list_id)
            {
                $listing[] = $list_id->list_id;
            }
          
            echo "<span class='blue'>Added on ".CommonClass::formatDatetime($model->date_added)."</span>"; 
        ?>     
        <div class="line"></div>
        <?php
        }
        ?>
     <div class="Subscribed_list">
     <h1>Subscribed Lists - <span class="blue">Add or remove from subscription lists</span></h1>
     <div class="line"></div>
     <?php foreach($subscribersdetail as $list): ?>
     <div class="checkbox-new" >
        <input type="checkbox" value="<?php echo $list->id;?>" name="subscriber_id[]" <?php if(in_array($list->id,$listing))echo "checked='checked'"; ?> />
          <?php echo " ".$list->title; ?>
     </div>
     <?php endforeach ;?>
     
     </div>

		<div class="<?php /*form-actions */ ?> greybg" style="margin-top: 10px;">
        <div class="floatLeft" style="margin-left: 150px;">
            <?php $this->widget('bootstrap.widgets.BootButton', array(
    			'buttonType'=>'submit',
    			'size'=>'large', // '', 'large', 'small' or 'mini'
    			'type'=>'primary',
                'label'=>$model->isNewRecord ? 'Create' : 'Submit',
		    )); ?>
        </div>
        <div class="floatRight">
            <?php if(!$model->isNewRecord){
                $this->widget('bootstrap.widgets.BootButton', array(
                        'label'=>'Delete',
                        'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //'size'=>'small', // '', 'large', 'small' or 'mini'
                        'htmlOptions'=>array('id'=>'delete',
                        'onClick'=>'$("#show").show(400);'),
                ));   
            } ?>
        </div>
        <div class="clear"></div>
	    </div>
        
    <div class="clear"></div>
    
  <div style="display: none;" id="show" class="alert">
    <div class="floatLeft margintop5"> Warning: This cannot be undone. Are you sure? </div>
    <div class="floatRight">
      <?php 
            $this->widget('bootstrap.widgets.BootButton', array(
                'type'=>'danger',
                //'size'=>'', // '', 'large', 'small' or 'mini'
                'url' => array('delete', 'id'=>$model->id),
                'label'=>'Delete',
        ));?>
      <?php
            $this->widget('bootstrap.widgets.BootButton', array(
    			'buttonType'=>'cancel',
    			//'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'', // '', 'large', 'small' or 'mini',
    			'label'=>'Cancel',
                'htmlOptions'=>array('id'=>'delete_'.$data->id,            
                'onClick'=>'$("#show").hide(400);'),            
		));?>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>

<?php $this->endWidget(); ?>
