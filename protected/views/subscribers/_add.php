<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/jquery-ui.js';?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/jquery.ui.touch.js';?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/QapTcha.jquery.js';?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/css/QapTcha.jquery.css';?>" media="screen" />

<div class="subNewsletter">
    <h2>FRESH INDUSTRY NEWS!</h2>
    <div class="line"></div>
    
    <div class="sub-content" style="<?php if($status=='success') echo "display: none;";?>"> Would you like the latest industry news served fresh to your inbox? Enter your details below.</div>

</div>

<?php if($status=='success') $this->widget('bootstrap.widgets.BootAlert'); ?>
<div id="subscriptionForm" style="<?php if($status=='success') echo "display: none;";?>">    
    <?php
         $url=  Yii::app()->request->requestUri; 
    	 $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
    			'id'=>'addform',
        		'type'=>'',
    			'action'=>Yii::app()->createUrl('/subscribers/add'),
    			//'method'=>'post',
    			'enableAjaxValidation'=>true,
       			'enableClientValidation'=>true,
        		'clientOptions'=>array(
    			     'validateOnSubmit'=>true,
    			),
        ));
    ?>
    <?php echo $form->hiddenField($model,'url',array('value'=>$url)); ?>
   <div class="input">
    <?php echo $form->textField($model, 'first_name', array('class'=>'','placeholder'=>'First Name')); ?>
    <?php echo $form->error($model,'first_name', array('class'=>'error')); ?>
    </div>
    
    <div class="input">
    <?php echo $form->textField($model, 'last_name', array('class'=>'','placeholder'=>'Surname')); ?>
    <?php echo $form->error($model,'last_name', array('class'=>'error')); ?>
    </div>
    
    <div class="input">                     
    <?php echo $form->textField($model, 'email', array('class'=>'','placeholder'=>'E-mail Address')); ?>
    <?php echo $form->error($model,'email', array('class'=>'error')); ?>
    </div>
    
    <div style="color: #FFF; font-size: 15px;"><strong>Human Check:</strong> Slide the arrow right</div>
    <div class="QapTcha"></div>
    <div class="clear"></div>
    
    <div class="controls" style="margin-top: 5px;">
        <input type="submit" value="Submit" name="submit" class="btn btn-primary btn-large" id="submitSubscription"/>
    </div>
    
    <div class="clear"></div>
    
    <?php $this->endWidget(); ?>
</div>