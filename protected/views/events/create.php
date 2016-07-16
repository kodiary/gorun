<div class="sidebar col-md-3">
          <?php echo $this->renderPartial('/sidebar/_menu', false, true); ?>
        </div>
        <div class="col-md-9 right-content profile_detail"> 
            <div class="col-md-12">
                <h1>Add your events</h1>
                <strong><span class="blue">Manage your event details here</span></strong>
            </div>
            <div class="clearfix"></div>
            <hr />
            <?php echo $this->renderPartial('/events/_form', false, true); ?>
            
        </div>
        <div class="clearfix"></div>
        <?php /*
<?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id'=>'cropModal',
        'options'=>array(
            'width'=>'auto',
            'height'=>'auto',
            'autoOpen'=>false,
            'resizable'=>false,
            'modal'=>true,
            'overlay'=>array(
                'backgroundColor'=>'#000',
                'opacity'=>'0.5'
            ),
            'close'=>"js:function(e,ui){ // to overcome multiple submission problem
                $('#cropModal').empty();
            }",
        ),
    ));
    //modal dialog content here
    
    $this->endWidget('zii.widgets.jui.CJuiDialog');
?>
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
<!-- Rght side bar end --><?php ?>
    <script>
    function confirm_delete(ques)
    {
        if(confirm(ques))
        {
            $('.profile_img').html('');
            $('.image_rows input').val('');
        }
        else
            return false;
    }
    $(function(){
			$( "#profile-detail" ).validate( {
			 onkeyup: false,
				rules: {
					fname: "required",
					lname: "required",
                    d_ob: "required",
                    m_ob: "required",
                    y_ob: "required",
                    gender: "required",
                    username: 'required',
					password_signup: {
						required: true,
						minlength: 5
					},
					confirm_password: {
						required: true,
						minlength: 5,
						equalTo: "#password_signup"
					},
					email: {
						required: true,
						email: true,
                        remote: {
                            url: "<?php echo Yii::app()->request->baseUrl;?>/member/checkemail?type=email",
                            type: "post",
                            data: {
                              email: function() {
                                return $( ".profile_email" ).val();
                                }

					       }
                        }
                    },
                    username: {
                        required: true,
                        remote: {
                            url: "<?php echo Yii::app()->request->baseUrl;?>/member/checkemail?type=username",
                            type: "post",
                            data: {
                              username: function() {
                                return $( ".username" ).val();
                                }

					       }
                        }
                    },
					agree: "required"
				},
                groups: {
                    y_ob: "d_ob m_ob y_ob"
                },
				messages: {
					fname: "Input a firstname",
					lname: "Input a lastname/Surname",
					password_signup: {
						required: "Input a password you will remember",
						minlength: "Your password must be at least 5 characters long"
					},
					confirm_password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long",
						equalTo: "Please enter the same password as above"
					},
					email: {
					    required:"Input an email address",
                        email: "Input a valid email address",
                        remote: $.validator.format("{0} is already taken.")
                    },
                	username: {
					    required:"Input a username",
                        remote: $.validator.format("{0} is already taken.")
                    },
					agree: "Please accept our policy",
                    y_ob: "Please select a date of birth",
                    m_ob: "Please select a date of birth",
                    d_ob: "Please select a date of birth",
                    gender: "Please select a gender"
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
                    
					error.addClass( "help-block" );

					if ( element.attr( "name" ) == "d_ob" || element.attr( "name" ) == "m_ob" || element.attr( "name" ) == "y_ob" ) {
						error.insertAfter( ".y_ob" );
					}
                    else if(element.prop('type')=== 'radio')
                    {
                        error.insertAfter( ('.f_gender'));
                    }
                     else {
						error.insertAfter( element );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".form-group, .dobs" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".form-group, .dobs" ).addClass( "has-success" ).removeClass( "has-error" );
				},
                
			} );

			
		} );
	</script>
    
    
    
    
    
    





<aside class="body_content_left floatLeft">
<div class="restaurant_menus_wrapper">
  <h2>Exhibition &amp; Event - <span class="blue">Create or Edit Events here.</span></h2>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php echo $this->renderPartial('application.modules.admin.views.events._form', array('model'=>$model,'venue'=>$venue,'events_link'=>$events_link)); ?>
<div class="clear"></div>
</div>
</aside>
<aside class="body_content_right floatRight">
  
    <?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => array('index'),
                    'label'=>'Cancel',
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));?>
    <div class="margintopbot10">
  <?php //$this->renderPartial('_search');?>
  </div>

</aside>
<div class="clear"></div>*/?>