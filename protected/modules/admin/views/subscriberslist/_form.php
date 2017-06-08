<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'subscribers-list-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>true),    
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php if($model->isNewRecord || $model->permanent==1)
         {
            echo $form->textFieldRow($model,'title',array('class'=>'span4','maxlength'=>255));
            if($model->permanent==1){
                
            }
            echo "<div class='clear'><div class='line' style='margin-top: 13px;'></div><div class='blue' style='margin-left:120px'>"."Added On ".CommonClass::formatDatetime($model->date_added)."</div></div>";
         }   
        else
        {
            echo "List Name: ".$model->title;
            echo $form->hiddenField($model,'title');   
        }    
    ?>
     <div class="line"></div>
    <div class="Members">
    <h1>EXSA Members - <span class="blue">Add or remove members to this list</span></h1>
    <div class="line"></div>
    <?php
        $com_list = array();
        $sub_list = array();
        
        $list = SubscribersDetail::model()->findAllByAttributes(array('list_id'=>$model->id));
        foreach($list as $l)
        {
            $com_list[] = $l->company_id;
            $sub_list[] = $l->subscriber_id;
        }    
        $companys = Company::model()->findAll();
        foreach($companys as $company)
        {?>
            <div class="email-list"><input type="checkbox" value="<?php echo $company->id ?>" name="company[]" <?php if(in_array($company->id,$com_list)) echo "checked='checked'"; ?> /><a href="<?php echo $this->createUrl('/admin/company/update/id/'.$company->id); ?>"> <?php echo $company->name; ?> <span class="blue"><?php echo $company->email; ?></span></a></div>       
    <?php
        }
    ?>
    
    </div>
    <div class="clear"></div>
    <div class="subscribers">
    <div class="line"></div>   
    <h1>Subscribers - <span class="blue">Add or remove members to this list</span></h1>
    <div class="line"></div>
    <?php
        $subscribers = Subscribers::model()->findAll();
        foreach($subscribers as $sub)
        {?>
            <div class="sus-list"><input type="checkbox" value="<?php echo $sub->id ?>" name="subscriber[]" <?php if(in_array($sub->id,$sub_list)) echo "checked='checked'"; ?> /><a href="<?php echo $this->createUrl('/admin/subscribers/update/id/'.$sub->id); ?>"> <?php echo $sub->first_name." ".$sub->last_name; ?> <span class="blue"><?php echo $sub->email; ?></span></a></div>       
    <?php
        }
    ?>
   
    </div>
    <div class="clear"></div>
    <div class="line"></div>
	<div class="greybg">
        <span class="floatLeft" style="margin-left: 120px; display: inline-block;">
            <?php $this->widget('bootstrap.widgets.BootButton', array(
    			'buttonType'=>'submit',
    			'size'=>'large', // '', 'large', 'small' or 'mini'
    			'type'=>'primary',
                'label'=>$model->isNewRecord ? 'Create' : 'Submit',
		    )); ?>
        </span>
        <span class="floatRight">
            <?php if(!$model->isNewRecord && $model->id>5){
                $this->widget('bootstrap.widgets.BootButton', array(
                        'label'=>'Delete',
                        'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //'size'=>'small', // '', 'large', 'small' or 'mini'
                        'htmlOptions'=>array('id'=>'delete',
                        'onClick'=>'$("#show").show(400);'),
                ));   
            } ?>
        </span>
         
        <div class="clear"></div>
	</div>
    <div class="clear"></div>
    
    <div style="display: none;" id="show" class="alert">
        <div class="floatLeft margintop5">
            Warning: This cannot be undone. Are you sure?
        </div>
        <div class="floatRight">
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'url' => array('delete', 'id'=>$model->id),
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'small' or 'large'
            ));?>
            
            <a class="cancel_button btn info" href="javascript:void(0)" id="cancel" onclick="$('#show').hide();">Cancel</a> 
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    
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
                'htmlOptions'=>array('id'=>'delete_'.$model->id,            
                'onClick'=>'$("#show").hide(400);'),            
		));?>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
<?php $this->endWidget(); ?>
