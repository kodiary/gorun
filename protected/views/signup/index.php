<div class="col-md-12">
    <div class="breadcrumb">
        <a class="home_bread" href="<?php echo Yii::app()->request->baseUrl; ?>"><span class="fa fa-home"></span></a><img class="right-point" src="<?php echo Yii::app()->request->baseUrl; ?>/images/rightpoint.png" />
        register or login 
        <img class="right-point_w" src="<?php echo Yii::app()->request->baseUrl; ?>/images/rightpoint_w.png" />
    </div>
</div>
<div class="content registration">
    <div class="col-md-4">
        <h2>Register now for free</h2>
        <hr />
        <div class="form-group col-md-12">
            <input type="text" name="fname" placeholder="Your first name" class="form-control" />
        </div>
        <div class="form-group col-md-12">
            <input type="text" name="lname" placeholder="Your last name/Surname" class="form-control" />
        </div>
        <div class="form-group col-md-12">
            <input type="text" name="email" placeholder="Your email" class="form-control" />
        </div>
        <div class="form-group col-md-12">
            <input type="password" name="fname" placeholder="Create Password" class="form-control" />
        </div>
        <div class="form-group col-md-12">
            <input type="password" name="fname" placeholder="Repeat Password" class="form-control" />
        </div>
        <div class="form-group dobs">
            <div><label class="control-label col-md-12">Date of Birth</label></div>
            <div class="col-sm-12">
            <select name="day_ob" class="col-md-4">
            <option value="">Day</option>
                <?php
                for($i=1;$i<32;$i++)
                {
                    ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php
                }
                ?>
            </select> 
            <select name="day_ob" class="col-md-4">
            <option value="">Month</option>
                <?php
                for($i=1;$i<13;$i++)
                {
                    ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php
                }
                ?>
            </select> 
            <select name="day_ob" class="col-md-4">
            <option value="">Year</option>
                <?php
                for($i=(date('Y')-100);$i<date('Y');$i++)
                {
                    ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php
                }
                ?>
            </select> 
            <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-md-12">
            <div class="col-md-6 whitebg"><input type="radio" name="gender" value="male" /> Male</div>
            <div class="col-md-6 whitebg"><input type="radio" name="gender" value="female" /> Female</div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-md-12">
            <input type="submit" value="Go!" class="btn btn-default bgblue btn-lg fullwidth" />
        </div>
        
    </div>
    <div class="col-md-4">
        <h2>Password reset</h2>
        <hr />
        <div class="form-group">
            <div>
                <label class="control-label col-md-12">Email</label>
            </div>
            <div class="col-sm-12">
                <input type="text" placeholder="Email or Username" name="email" class="form-control" />
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-12">
            <input type="submit" value="REQUEST PASSWORD RESET" class="btn btn-default bgblue btn-lg fullwidth" />
        </div>
    </div>
    <div class="col-md-4">
        <h2>Member Login</h2>
        <hr />
        <div class="form-group">
            <label class="control-label col-md-12">Email</label>
            <div class="col-sm-12"><input type="text" name="email" placeholder="Email or Username" class="form-control" /></div>
            <div class="clearfix"></div>           
            
        </div>
        
        <!-- Success -->
        <div class="form-group has-success has-feedback">
            <label class="control-label  col-md-12" for="inputSuccess3">Email</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" name="email" placeholder="Email or Username" id="inputSuccess3" aria-describedby="inputSuccess3Status">
              <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
              <span id="helpBlock2" class="help-block">Email or Username is not valid.</span>
              <span id="inputSuccess3Status" class="sr-only">(success)</span>
            </div>
            <div class="clearfix"></div>  
          </div>
         <!--Error --> 
        <div class="form-group has-error has-feedback">
            <label class="control-label  col-md-12" for="inputError3">Email</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" name="email" placeholder="Email or Username" id="inputError3" aria-describedby="inputError3Status">
              <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
              <span id="helpBlock2" class="help-block">Email or Username is not valid.</span>
              <span id="inputError3Status" class="sr-only">(error)</span>
            </div>
            <div class="clearfix"></div>  
          </div>
          
        
          
        
        <div class="form-group">
            <label class=" col-md-12">Password</label>
            <div class=" col-md-12"><input type="password" name="password" placeholder="Password" class="form-control" /></div>
            <div class="clearfix"></div>            
            
        </div>
        
        <div class="form-group  col-md-12">
            
            <div class=""><input type="submit" name="submit" value="Login to your account" class="btn btn-default bgblue btn-lg fullwidth" /></div>
            <div class="clearfix"></div>
            <div class="remember">
                <input type="checkbox" name="remember" /> Remember Me
            </div>
            <div class="clearfix"></div>            
            
        </div>
      <div class="center"> 
        Not a member yet? <a href="#" class="blue">Join now for free.</a> 
      </div>
      
    </div>
    <div class="clearfix"></div>
</div>

<?php /*<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/jquery-ui.js';?>"></script>
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
</div>*/?>

