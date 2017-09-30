        <div class="form-group main_email">
            <label class="col-md-12">Email</label>
            <div class="col-md-12">
                <input type="email" id="LoginForm_username" name="LoginForm_username"  placeholder="Email or Username" class="form-control" />
                <input type="hidden" value="<?php echo Yii::app()->request->url;?>" />
            </div>
            <div class="clearfix"></div>           
            
        </div>
        
        <div class="form-group has-feedback password">
            <label class="col-md-6">Password</label>
            <label class="col-md-6"><span class="blue right reset"><strong><a href="<?php echo Yii::app()->request->baseUrl;?>/member/passwordreset">Reset</a></strong></span></label>
            <div class="col-md-12">
                <input type="password" id="LoginForm_password" name="LoginForm_password"  placeholder="Your Password" class="form-control password" />
                <span  class="failed_pwd help-block" style="display: none;">Password is required.</span>
            </div>
            <div class="clearfix"></div>            
            
        </div>
         <div class="form-group has-error has-feedback error-login" style="display: none;">
            
            <div class="col-sm-12">
              
              <span class="help-block">Invalid Username/Email or Password.</span>
              
            </div>
            <div class="clearfix"></div>  
          </div>
           <div class="form-group has-error has-feedback error-verification" style="display: none;">
            
            <div class="col-sm-12">
              
              <span class="help-block">Email not verified. Please verify your email.</span>
              
            </div>
            <div class="clearfix"></div>  
          </div>
        
        
        <div class="form-group">
            <input type="hidden" name="ajax" value="login-form"/>
            <div class="col-md-12">
                <button type="submit" name="login" class="form-control btn btn-default bgblue bottom-border" >LOGIN TO YOUR ACCOUNT</button></div>
            <div class="clearfix"></div>
            <hr />
            <div class=" center col-md-12">
                <a href="<?php echo Yii::app()->request->baseUrl;?>/hybridauth/default/login?provider=google"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/googlesign.png" /></a><br />
                <!--a href="<?php echo Yii::app()->request->baseUrl;?>/hybridauth/default/login?provider=facebook"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/fbsign.png" /></a><br /-->
                <a href="javascript:void(0)" onclick="checkLoginState();"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/fbsign.png" /></a>
                
            </div>
            <div class="remember control-group">
                <label class="control control--checkbox">Remember Me
            		<input type="checkbox" name="remember"/>
            		<div class="control__indicator"></div>
            	</label>
                
            </div>
            <div class="clearfix"></div>            
            
        </div>
       
<script>
$(function(){
    $('.reset').click(function(){
        $('.login-form input').each(function(){
            $(this).val("");
        });
    });
})
</script>       
      