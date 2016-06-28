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
    <h1>Apply for Membership Now!</h1>
    <h2>Join EXSA and enjoy all the benefits as well as listing your company on the website.</h2>
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
</div>

<div class="body_content_right">
<div class="signup-form">

<div class="all_f_left signupRight">
  <p class="blue"><a href="mailto:info@exsa.co.za"><img src="http://localhost/gorun/Button.jpg" alt="" name="SignUp" width="301" height="282" id="dasdas" /></a>
    <?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
    'id'=>'company-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
</p>
  <div class="inputs">
    <?php if(CCaptcha::checkRequirements()): ?>
	</div>
  <div class="control-group captcha">
    <div class="fl_left">
            <div class="margintop5" style="color: #006EB4; font-size: 15px; font-weight:bold;"></div>
            <div class="clear"></div>
		</div>
        <div class="fl_right">
		</div>
        <div class="clear"></div>
	</div>
    
	<?php endif; ?>
    <?php $this->endWidget(); ?>
</div>

</div>
<div class="member-signup"><a href="<?php echo $this->createUrl('/company/login') ?>"><strong>ALREADY A MEMBER?</strong><br />Click here to login to the <strong>EXSA Member Area</strong></a></div>
</div>
<div class="clear"></div>
</div>

