<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/jquery-ui.js';?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/jquery.ui.touch.js';?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/QapTcha.jquery.js';?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/css/QapTcha.jquery.css';?>" media="screen" />

<?php
$this->breadcrumbs=array(
	'list your company',
);?>

<div id="sign-up">
<div class="body_content_left signupPage">
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
    <h1>List your company right now!</h1>
    <h2>Sign now and enjoy all the benefits as well as listing your company on the website.</h2>
<h4><strong>Why join EXSA?</strong></h4>
<ul style="margin-bottom: 20px;">
<li>&gt; The Industry Association for South African</li>
<li>&gt; Resource Guide / Diary</li>
<li>&gt; Skills Development</li>
</ul>

<div class="lists-signup">
<div class="sigContainer fl_left">
    <div class="sigContImg fl_left">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/credability.png" alt="exsa.co.za" />
    </div><!-- sigContImg -->
    <div class="signContTxt fl_right">
        <p><strong>Credability - </strong>
        If you were looking for a supplier in the exhibition & event industry on the internet you search under EXSA - of course!
        </p>
    </div><!-- sigContText -->
    <div class="clear"></div>
</div><!-- sigContainer -->

<div class="sigContainer fl_right">
    <div class="sigContImg fl_left">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/events.png" alt="exsa.co.za" />
    </div><!-- sigContImg -->
    <div class="signContTxt fl_right">
        <p><strong>Events & Exhibitions - </strong>
        Events & exhibitions will be advertised free of charge on the website. Easy to create and it includes venue, days, times and a google map.
        </p>
    </div><!-- sigContText -->
    <div class="clear"></div>
</div><!-- sigContainer -->


<div class="clear"></div>


<div class="sigContainer fl_left">
    <div class="sigContImg fl_left">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/updated.png" alt="exsa.co.za" />
    </div><!-- sigContImg -->
    <div class="signContTxt fl_right">
         <p><strong>Keep it updated -</strong>
         Keep your company details updated by logging on. You can update every element of your page, including all text, pictures, specials, events and videos.
         </p>
    </div><!-- sigContText -->
    <div class="clear"></div>
</div><!-- sigContainer -->

<div class="sigContainer fl_right">
    <div class="sigContImg fl_left">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/smile.png" alt="exsa.co.za" />
    </div><!-- sigContImg -->
    <div class="signContTxt fl_right">
        <p><strong>Simple to Use -</strong>
        We give you all the power in the admin panel, so it is easy to manage your company listing.
        </p>
    </div><!-- sigContText -->
    <div class="clear"></div>
</div><!-- sigContainer -->
<div class="clear"></div>
</div>

        <div class="signup-bigimage"> 
      <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/big.png" alt="http://exsa.co.za/" />
  </div>


      <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/create.png" alt="http://exsa.co.za/" />

<div class="clear"></div>

<?php //$this->renderPartial("/site/_bottomBanner");?>

</div>

<div class="body_content_right">
<div class="signup-form">

<div class="all_f_left signupRight">
<p class="blue"><strong>Join EXSA now and enjoy the benefits.</strong><br/>Start below...</p>
<div class="line"></div>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
    'id'=>'company-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
<div class="inputs">
    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model,'name',array('class'=>'span4',  'placeholder'=>'Company Name')); ?>
    <?php echo $form->error($model, 'name'); ?>
    </div>
<div class="inputs">    
    <?php echo $form->labelEx($model, 'contact_person'); ?>
    <?php echo $form->textField($model,'contact_person',array('class'=>'span4', 'placeholder'=>'Contact Person')); ?>
    <?php echo $form->error($model, 'contact_person'); ?>
    </div>
<div class="inputs">    
    <?php echo $form->labelEx($model, 'number'); ?>
    <?php echo $form->textField($model,'number',array('class'=>'span4' , 'placeholder'=>'Contact Number')); ?>
    <?php echo $form->error($model, 'number'); ?>
    </div>
<div class="inputs">    
    <?php echo $form->labelEx($model, 'email'); ?>
    <?php echo $form->textField($model,'email',array('class'=>'span4 yellow_input', 'placeholder'=>'E-mail Address')); ?>
    <?php echo $form->error($model, 'email'); ?>
    </div>
<div class="inputs">    
    <?php echo $form->labelEx($model, 'password_real'); ?>
    <?php echo $form->passwordField($model,'password_real',array('class'=>'span4','maxlength'=>30, 'placeholder'=>'Password')); ?>
   <?php echo $form->error($model, 'password_real'); ?>
   </div>
<div class="inputs">    
    <?php echo $form->labelEx($model, 'repeat_password'); ?>
    <?php echo $form->passwordField($model,'repeat_password',array('class'=>'span4','maxlength'=>30, 'placeholder'=>'Repeat Password')); ?>
    <?php echo $form->error($model, 'repeat_password'); ?>
    </div>
    
    <?php echo $form->hiddenField($model,'status',array('value'=>0)); ?>
    <?php if(CCaptcha::checkRequirements()): ?>
	<div class="control-group captcha">
        <div class="fl_left">
            <div class="margintop5" style="color: #006EB4; font-size: 15px; font-weight:bold;">Human Check: Slide the arrow right</div>
            <div class="QapTcha"></div>
            <div class="clear"></div>
		</div>
        <div class="fl_right">
		</div>
        <div class="clear"></div>
	</div>
    
	<?php endif; ?>
    <div class="line"></div>

    <input type="submit" value="Get Started!" name="submit" class="btn btn-primary btn-large"/>

<?php $this->endWidget(); ?>
</div>

</div>
<div class="member-signup"><a href="<?php echo $this->createUrl('/company/login') ?>"><strong>ALREADY A MEMBER?</strong><br />Click here to login to the <strong>EXSA Member Area</strong></a></div>
</div>
<div class="clear"></div>
</div>

