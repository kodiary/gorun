<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<div class="adminLogin">
<h1>LOGIN</h1>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
    'enableClientValidation'=>true,
    'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<div class="form-group"> 
    <label class="col-md-3">Username</label>
    <div class="col-md-9"><?php echo $form->textField($model, 'username', array('class'=>'form-control')); ?></div>
    <div class="clearfix"></div>
</div>
<div class="form-group"> 
    <label class="col-md-3">Password</label>
    <div class="col-md-9"><?php echo $form->passwordField($model, 'password', array('class'=>'form-control')); ?></div>
    <div class="clearfix"></div>
</div>
<hr/>
<div class="form-group">
    <input type="submit" value="Login" class="btn btn-default" />
</div>

<?php $this->endWidget(); ?>
</div><!-- form -->