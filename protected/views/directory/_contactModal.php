<div class="contactPopup">
    <script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/jquery-ui.js';?>"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/jquery.ui.touch.js';?>"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/QapTcha.jquery.js';?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/css/QapTcha.jquery.css';?>" media="screen" />
    <?php
    $model = new ContactForm('contactCompany');
    $this->beginWidget('bootstrap.widgets.BootModal', array(
    		'id' => 'contactModal',
    		'options' => array(
    			'title' => 'Submit Enquiry',
    			),
            'htmlOptions'=>array('style'=>'width:auto;','class'=>'popUp'),
    		));
    ?>
    <div class="modal-header">
        <h3>Send Message</h3>
        <a class="close" data-dismiss="modal" >&times;</a>
        <div class="clear"></div>
    </div>
    
    <div class="modal-body">
    <div id="contactTo"></div>
    <div class="line"></div>	
    <?php 
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
        'id'=>'contactForm',
        'type'=>'horizontal',
         'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true,
                 'validateOnType' => false,
                 'afterValidate'=>'js:submitContactForm'
            ), 
    )); ?>
    
    <p><?php echo $form->textField($model, 'name', array('placeholder'=>'Your Name')); ?>
    <div><?php echo $form->error($model,'name');?></div></p>
    <p><?php echo $form->textField($model, 'contact', array('placeholder'=>'Contact Number')); ?>
    <div><?php echo $form->error($model,'contact');?></div></p>
    <p><?php echo $form->textField($model, 'email', array('placeholder'=>'E-mail Address')); ?>
    <div><?php echo $form->error($model,'email');?></div></p>
    <p><?php echo $form->textArea($model, 'body', array('placeholder'=>'Message')); ?>
    <div><?php echo $form->error($model,'body');?></div></p>
    <input type="hidden" name="link" value="<?php echo $this->createAbsoluteUrl(Yii::app()->request->requestUri); ?>"/>
    <input type="hidden" name="contactFor" value="" id="contactFor"/>
    <input type="hidden" name="toEmail" value="" id="toEmail"/>
    
     <?php //Captcha
     if(CCaptcha::checkRequirements()): ?>
    	<div class="control-group captcha">
            <div class="fl_left">
                <div class="margintop5" style="color: #FFF; font-size: 15px; font-weight:bold">Human Check: Slide the arrow right</div>
                <div class="QapTcha" style="margin-top: 8px;"></div>
                <div class="clear"></div>
    		</div>
            <div class="fl_right"></div>
            <div class="clear"></div>
    	</div>
        
        <div class="seperator"></div>
    	<?php endif; 
        //--end captcha?>
    
        
    <div class="line_10"></div>
    <div class="control-group">
    <div class="controls smbtns"  style="margin: 0;">
        <input type="submit" value="Send Message" name="submit" class="btn btn-primary btn-large" style="margin: 5px 0 0;" id="sub"/>
    </div>
    </div>
    
    <?php $this->endWidget(); ?> <!-- form ends -->
    </div> <!-- modal-body ends-->
    <?php $this->endWidget(); ?><!-- modal ends -->
</div>
<script type="text/javascript">
    jQuery(function($){
        $('.QapTcha').QapTcha({
          disabledSubmit:true,
          autoSubmit : false,
          autoRevert : true,
          PHPfile : '<?php echo Yii::app()->baseUrl."/js/Qaptcha.jquery.php"; ?>',
        });
    });
	function submitContactForm(form, data, hasError)	
	{
		if(!hasError)
		{	
	        $('#sub').val("Sending...");
			$.ajax({
			type:'post',
			url:"<?php echo $this->createUrl('//directory/contact'); ?>",
			data:$("#contactForm").serializeArray(),
			success: function(data)
			{
				if(data==1)
				{
					$('.modal-body').html('<strong>Success - Message has been sent.</strong>');
				}
				if(data=='Failed')
				{
						$('.modal-body').html('<strong>Error - Message submission failed.</strong>');
					
				}	
				return false;
			}
			});	
			
		}	
	}
</script>