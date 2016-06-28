<div class="body_content_left">
<div class="all_f_left">
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<?php
$this->breadcrumbs=array(
	'list your company'=>array('/signup'),
	'Success',
);?>
<h1>List Your Company</h1>
<p class="hd_des">Sign up now to list your company on the best directory in South Africa</p>
<div class="line"></div>

<div class="alert alert-block alert-info fade in" style="margin-bottom:0;"><a class="close" data-dismiss="alert">&times;</a><span class="bold">Success!</span> Please check your email now to confirm your email address.</div>
<div class="line"></div>
An activation email has been sent to "<b><?php echo $info->email;?></b>"<br/>Please check your email now and click on the link to activate your listing.
<div class="line"></div> 
<div style="text-align:center;">
<?php echo CHtml::link('Resend Activation Email',array('/signup/resend/id/'.$info->id),array('class'=>'btn btn-primary btn-large')); ?>
</div>

</div>
</div>
<div class="clear"></div>