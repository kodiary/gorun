<div class="body_content_left">
<div class="all_f_left">
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<?php
$this->breadcrumbs=array(
	'list your company'=>array('/signup'),
	'Success',
);?>
<h1>List Your company</h1>
<p class="hd_des">Sign up now to list your company on the best directory in South Africa</p>
<div class="line"></div>

<div class="alert alert-block alert-info fade in" style="margin-bottom:0;"><a class="close" data-dismiss="alert">&times;</a><span class="bold">Success!</span> You have signed up - now complete your company profile.</div>
<div class="line"></div>

<div style="text-align:center;">
<?php echo CHtml::link('Complete Company Profile',array('/company/info'),array('class'=>'btn btn-primary btn-large')); ?>
</div>

</div>
</div>
<div class="clear"></div>