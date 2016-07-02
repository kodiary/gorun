<div class="sidebar col-md-3">
          <?php echo $this->renderPartial('/dashboard/_menu', false, true); ?>
        </div>
        <div class="col-md-9 right-content profile_detail">
            <div class="col-md-12">
                <h1>YOUR PROFILE DETAIL</h1>
                <strong><span class="blue">Private and Confidential.</span> All information here is not openly shared.</strong>
            </div>
            <div class="clearfix"></div>
            <hr />
            <form action="">
                <div class="form-group">
                    <label class="col-md-2">First Name<span class="required">*</span></label>
                    <div class="col-md-8"><input type="text" class="form-control" placeholder="Your First Name" name="fname" /></div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-2">Last Name<span class="required">*</span></label>
                    <div class="col-md-8"><input type="text" class="form-control" placeholder="Your Last Name" name="lname" /></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">Username<span class="required">*</span></label>
                    <div class="col-md-8"><input type="text" class="form-control" placeholder="Username" name="username" /></div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-2">Example</label>
                    <div class="col-md-8"><strong><span class="required">http://www.gorun.co.za/username</span></strong></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">Email<span class="required">*</span></label>
                    <div class="col-md-8"><input type="text" class="form-control" placeholder="Your Email Address" name="email" /></div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-8"><span class="blue">Your e-mail address is used for your login - <strong>Input carefully</strong></span></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">Mobile</label>
                    <div class="col-md-8"><input type="text" class="form-control" placeholder="Your Mobile Number" name="mobile" /></div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-8"><span class="blue">Used for password reminder - <strong>Optional</strong></span></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">Date of Birth<span class="required">*</span></label>
                    <div class="col-md-8">
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
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2">Gender<span class="required">*</span></label>
                    <div class="col-md-8">
                        <div class="col-md-6 whitebg"><input type="radio" name="gender" value="male" /> Male</div>
                        <div class="col-md-6 whitebg"><input type="radio" name="gender" value="female" /> Female</div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">Profile Photo</label>
                    <div class="col-md-8 profilepic">
                    <div class="profile_img">
                    
                    </div>
                    <div class="col-md-6 picact">
                        <a href="javascript:void(0)" class="btn btn-primary">Upload</a><br />
                        <a href="javascript:void(0)" class="btn btn-default">Crop</a><br />
                        <a href="javascript:void(0)" class="btn btn-danger">Remove</a><br />
                    </div>
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">SA Identity No.</label>
                    <div class="col-md-8"><input type="text" class="form-control" placeholder="Your SA Identity Number" name="sa_identity_no" /></div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-8"><span class="blue">Input your <strong>SA Identity Number</strong> to track your results - <strong>Optional</strong></span></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">Championchip</label>
                    <div class="col-md-8"><input type="text" class="form-control" placeholder="Your Championchip Number" name="championchip" /></div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-8"><span class="blue">Input your <strong>Championchip Number</strong> to track your results - <strong>Optional</strong></span></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">TraceTec</label>
                    <div class="col-md-8"><input type="text" class="form-control" placeholder="Your TraceTec Number" name="tracetec" /></div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-8"><span class="blue">Input your <strong>TraceTec Number</strong> to track your results - <strong>Optional</strong></span></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                <input type="submit" value="Save Changes" class="btn btn-default bgblue btn-lg" />
                </div>
                
            </form>
            
        </div>
        <div class="clearfix"></div>
<?php /*$this->breadcrumbs=array('Welcome to the exhibition and event association of southern africa');?>
<div id="fb-root"></div>
 <?php
    if($sliders)
    {
    ?>
      <div class="slider">
        <?php $this->renderPartial('_slider',array('sliders'=>$sliders));?>
            <div class="clear"></div>
      </div>
      <!--slider-->
    <?php
    }
?>
<div class="body_content_left">
<?php
    if($model)
    {
    ?>
        <div class="home-desc"><?php echo $model->desc;?></div>
    <?php
    }
?>
<div class="latest-news-new">
    <div class="fl_left">Latest News</div>
    <div class="fl_right"><a href="<?php echo $this->createUrl('/news'); ?>">View More</a></div>
    <div class="clear"></div>
</div>
 <?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$articlesData,
    'pager' => array(
        'class'=>'bootstrap.widgets.BootPager',
        'maxButtonCount'=>5,
    ),
	'itemView'=>'_articles',
    'summaryText'=>'',
	'emptyText'=>'',
    'viewData'=>array('section'=>'articles') 
)); ?>

<div style="margin-top:6px;">
    <div class="floatLeft"><a  style=" font-size: 17px; color:#666666; margin-top:5px; display:inline-block; margin-top:4px;" href="<?php echo $this->createUrl('/news'); ?>" class="viewMoreArticles">View More Articles</a></h2></div>
    <div class="floatRight"><a  href="<?php echo $this->createUrl('/news'); ?>" class="btn btn-info">View More</a></div>
    <div class="clear"></div>
</div>


<!-- bottom banner-->
<?php $this->renderPartial('_bottomBanner');?>
</div><!--#body_content_left-->

<div class="body_content_right">
<!-- Right side bar -->
<?php $this->renderPartial('_eventCalender');?>


<div class="subNewsletter">
    <h2>FRESH INDUSTRY NEWS!</h2>
    <div class="line"></div>
    
    <div class="sub-content">Would you like the latest industry news served fresh to your inbox? Enter your details below.</div>
    <div class="line"></div>
    <div id="subscriptionLink"><a href="<?php echo $this->createUrl('/subscribers')?>">SUBSCRIBE NOW <i class="icon-circle-arrow-right"></i></a></div>
</div> 

<?php $this->renderPartial('_patron_members', array('patronslider'=>$patronslider));?>

<div class="like_box">
<?php echo $this->renderPartial('_fblikebox')?>
</div>

<?php $this->renderPartial('_squareBanner');?>
</div><!--#body_content_right-->
<div class="clear"></div>
<!-- Rght side bar end --><?php */?>