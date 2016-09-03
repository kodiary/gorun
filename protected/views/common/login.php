        <div class="form-group main_email">
            <label class="col-md-12">Email</label>
            <div class="col-md-12">
                <input type="email" id="LoginForm_username" name="LoginForm_username"  placeholder="Email or Username" class="form-control" />
                <input type="hidden" value="<?php echo Yii::app()->request->url;?>" />
            </div>
            <div class="clearfix"></div>           
            
        </div>
        
        <div class="form-group has-feedback password">
            <label class="col-md-12">Password</label>
            <div class="col-md-12">
                <input type="password" id="LoginForm_password" name="LoginForm_password"  placeholder="Password" class="form-control password" />
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
                <input type="submit" name="login" value="Login to your account" class="form-control btn btn-default bgblue" /></div>
            <div class="clearfix"></div>
            <div class="remember">
                <input type="checkbox" name="remember" /> Remember Me
            </div>
            <div class="clearfix"></div>            
            
        </div>
       
        
      