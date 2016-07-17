<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
 <div class="col-md-8">
<div class="restaurant_menus_wrapper">
<div class="line"></div>
    <h2>Contact Webmaster - <span>Have a question - send it to us here</span> <?php echo $company?></h2>
    <div class="line"></div>
       <?php /** @var BootActiveForm $form */
        $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
            'type'=>'horizontal',
            'enableClientValidation'=>true,
        	'clientOptions'=>array(
        		'validateOnSubmit'=>true,
        	),
        )); 
        ?>
       <div class="form_textarea">
       <?php echo $form->textArea($model,'body',array('class'=>'span6', 'rows'=>10, 'cols'=>10)); ?>
       <?php echo $form->error($model,'body'); ?>
       </div>
        
        <div class="line"></div>
        <div style="text-align:center;">
         <?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Send',
            'size'=>'large',
            'htmlOptions'=>array('name'=>'contactCompany'),
		)); ?>
        </div>
    <?php $this->endWidget();?>
</div>
</div>
    <div class="col-md-4">
    <?php
      $url=array('/admin/company/update/id/'.$_GET['id']);  
    ?>
        <?php echo CHtml::link('Cancel',$url,array('class'=>'btn'))?>
    </div>
    <div class="clear"></div>
</div>
