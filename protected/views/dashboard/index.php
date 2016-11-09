<script src="//cdn.ckeditor.com/4.5.10/basic/ckeditor.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<div class="sidebar col-md-3">
          <?php echo $this->renderPartial('/sidebar/_menu', ['not_verified'=>$not_verified], true); ?>
        </div>
        <div class="col-md-9 right-content profile_detail"> 
            <div class="col-md-12">
                <h1>YOUR PROFILE DETAILS</h1>
                <strong><span class="blue">Private and Confidential.</span> All information here is NOT openly shared.</strong>
            </div>
            <div class="clearfix"></div>
            <hr />
            <form action="<?php echo Yii::app()->request->baseUrl;?>/dashboard" id="profile-detail" method="post">
                <div class="form-group">
                    <label class="col-md-2">First Name <span class="required">*</span></label>
                    <div class="col-md-9"><input type="text" class="form-control" placeholder="Your First Name" name="fname" value="<?php echo $member->fname;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-2">Last Name <span class="required">*</span></label>
                    <div class="col-md-9"><input type="text" class="form-control" placeholder="Your Last Name" name="lname" value="<?php echo $member->lname;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">Username <span class="required">*</span></label>
                    <div class="col-md-9"><input type="text" class="form-control username" placeholder="Username" name="username" value="<?php echo $member->username;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-2">Example</label>
                    <div class="col-md-9"><strong><span class="required">http://www.gorun.co.za/username</span></strong></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">Email <span class="required">*</span></label>
                    <div class="col-md-9"><input type="text" class="form-control profile_email" placeholder="Your Email Address" name="email" value="<?php echo $member->email;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-9"><span class="blue">Your e-mail address is used for your login - <strong>Input carefully</strong></span></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">Mobile</label>
                    <div class="col-md-9"><input type="text" class="form-control" placeholder="Your Mobile Number" name="mobile" value="<?php echo $member->mobile;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-9"><span class="blue">Used for password reminder - <strong>Optional</strong></span></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                <?php $date = explode("-",$member->dob);?>
                <div class="form-group dobs">
                    <label class="col-md-2">Date of Birth <span class="required">*</span></label>
                    <div class="col-md-5">
                        <select name="d_ob" class="col-md-3">
                            <option value="">Day</option>
                            <?php
                            for($i=1;$i<32;$i++)
                            {
                                ?>
                                <option value="<?php echo $i;?>" <?php if($date[2]==$i)echo "selected='selected'";?>><?php echo $i;?></option>
                                <?php
                            }
                            ?>
                        </select> 
                        <select name="m_ob" class="col-md-4">
                            <option value="">Month</option>
                            <?php
                            for($i=1;$i<13;$i++)
                            {
                                ?>
                                <option value="<?php echo $i;?>" <?php if($date[1]==$i)echo "selected='selected'";?>><?php echo $i;?></option>
                                <?php
                            }
                            ?>
                        </select> 
                        <select name="y_ob" class="col-md-3 y_ob" style="margin-left: 0;">
                            <option value="">Year</option>
                            <?php
                            for($i=(date('Y')-100);$i<date('Y');$i++)
                            {
                                ?>
                                <option value="<?php echo $i;?>" <?php if($date[0]==$i)echo "selected='selected'";?>><?php echo $i;?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2">Gender <span class="required">*</span></label>
                    <div class="col-md-9">
                        <div class="col-md-2 ">
                            <label class="control control--radio">Male
                              <input type="radio" name="gender" value="1" <?php if($member->gender == '1')echo "checked='checked'";?>/>
                              <div class="control__indicator"></div>
                            </label>
                        </div>    
                        <div class="col-md-6 ">
                             <label class="control control--radio">Female
                                <input type="radio" name="gender" value="0" <?php if($member->gender == '0')echo "checked='checked'";?>/>
                                <div class="control__indicator"></div>
                            </label>
                       </div> 
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <hr class="margin-10" />
                  <div class="form-group">
                    <h2 class="col-md-12">About You <span class="grey">Optional</span></h2>
                    <div class="clearfix"></div>
                  </div>
                <hr class="margin-10"/>
                <div class="form-group">
                    <label class="col-md-12"><span class="blue">Tell us about yourself. </span>Limited to 600 characters - <span class="blue">You have <span class="count_letter">600</span> left</span></label>
                    <div class="col-md-12">
                   
                     
                    <script>
                            tinymce.init({
                                selector:'textarea',
                                statusbar: false,
                                menubar: false,
                                plugins:['hr link pagebreak'],
                                toolbar: ['bold italic strikethrough bullist numlist blockquote hr alignleft aligncenter alignright link unlink pagebreak'],
                                setup:function(ed) {
                                   ed.on('keyup', function(e) {
                                        tmp = ed.getContent({format : 'text'});
                                        currentLength= tmp.length;
                                        maximumLength = 10;
                                        var rem_text = maximumLength-currentLength;
                                        $('.count_letter').text(rem_text);
                                        
                                        if( currentLength > maximumLength )
                                        {
                                            ed.undoManager.add();
                                            ed.undoManager.transact(function(){
                                                ed.setContent(ed.getContent({format : 'text'}).substring(0,10));
                                                $('.count_letter').text(0);
                                                ed.undoManager.undo();
                                             });
                                             //ed.undoManager.undo();
                                            //tinyMCE.execCommand("mceRemoveControl", true, 'description');
                                            //tinymce.activeEditor.getBody().setAttribute('contenteditable', false);
                                        }
                                        else
                                        {
                                            ed.undoManager.clear();
                                        }
                                       /*console.log('the event object ', e);
                                       console.log('the editor object ', ed);
                                       console.log('the content ', ed.getContent().replace(/<(?:.|\n)*?>/gm, ''));*/
                                   });
                                   },
                                
                                });
                                
                    </script>
                     
                    
                    <?php /*  
                        // Create Editor instance and use Text property to load content into the RTE.  
                            $rte=new RichTextEditor();
                            $rte->Text=$member->detail;
                            $rte->Name="Editor1";
                            $rte->Height="200px";
                            $rte->Skin="officexpsilver";
                            $rte->Toolbar="minimal";
                            $rte->MvcInit();
                        // Render Editor 
                        echo $rte->GetString();  */
                    ?> 
                    <textarea class="form-control description" id="description" name="detail"><?php echo $member->detail;?></textarea>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    
                    <h2 class="col-md-12">Profile Photo <span class="grey">Optional</span></h2>
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    
                    <div class="col-md-9 profilepic">
                    <div class="profile_img img-circle" id="upimage_0">
                    <?php
                    $img_url = Yii::app()->baseUrl.'/images/blue.png';
                    if($member->logo && file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$member->logo))
                    {
                        $img_url=Yii::app()->baseUrl.'/images/frontend/thumb/'.$member->logo;
                        
                    }
                    echo '<img src="'.$img_url.'" class="img-circle" width="100%" height="100%"/>';
                    ?>
                        
                    </div>
                    <div class="col-md-6 picact" style="margin-left: 20px;margin-top: 30px;">
                    <?php echo $this->renderPartial('application.views.gallery._addImage',array('member'=>$member,'type'=>'member')); ?>
                        
                      
            <?php
                        
            //crop button
             echo CHtml::ajaxLink('<span class="fa fa-crop"></span> Crop',
                        $this->createUrl('gallery/cropPhoto?height=215&width=215'),
                         array( //ajax options
                         'data'=>array('fileName'=>"js:function(){ return $('.uploaded_image').val()}",'id'=>$member->id),
                         'type'=>'POST',
                        'success'=>"js:function(data){
                                    if(data!=''){
                                        $('#cropModal').html(data).dialog('open');
                                        $('.ui-dialog-titlebar-close').hide();
                                         return false;
                                    }
                                    else
                                        alert('No Image selected');
                                    }",
                        'complete'=>"js:function(){
                                      $('#crop_".$member->id."').val('Crop');
                                    }",
                        ),
                        array('id'=>'crop_'.$member->id,'class'=>'btn btn-crop','onclick'=>'$("#crop_'.$member->id.'").val("loading...");')//html options
            );
            ?><br />
            
                        
                        <a href="javascript:void(0)" class="btn btn-remove" onclick="return confirm_delete('Are you sure that you want to remove the image?'); "><span class="fa fa-times" style="color: #E00000;"></span> Remove</a><br />
                    </div>
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
              
                <div class="form-group">
                    
                    <h2 class="col-md-12">Cover Photo <span class="grey">Optional</span></h2>
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    
                    <div class="col-md-12 profilepic">
                    <div class="profile_cover" id="upimage_1">
                    <?php
                    if($member->cover && file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$member->cover))
                    {
                        $img_url=Yii::app()->baseUrl.'/images/frontend/thumb/'.$member->cover;
                        echo '<img src="'.$img_url.'"/>';
                    }
                    
                    ?>
                        
                    </div>
                    
                    <div class="col-md-6 picact">
                        <span class="blue"><strong>Size is 760x220px</strong></span>
                    </div>
                    <div class="col-md-6 picact">
                    <?php echo $this->renderPartial('application.views.gallery._addImagecover',array('member'=>$member,'type'=>'member_cover','id'=>1)); ?>
                        
                      
            <?php
                        
            //crop button
             echo CHtml::ajaxLink('<span class="fa fa-crop"></span> Crop',
                        $this->createUrl('gallery/cropPhoto?height=220&width=760&crop_cover=cover'),
                         array( //ajax options
                         'data'=>array('fileName'=>"js:function(){ return $('.uploaded_cover').val()}",'id'=>$member->id),
                         'type'=>'POST',
                        'success'=>"js:function(data){
                                    if(data!=''){
                                        $('#cropModal').html(data).dialog('open');
                                        $('.ui-dialog-titlebar-close').hide();
                                         return false;
                                    }
                                    else
                                        alert('No Image selected');
                                    }",
                        'complete'=>"js:function(){
                                      $('#crop1_".$member->id."').val('Crop');
                                    }",
                        ),
                        array('id'=>'crop1_'.$member->id,'class'=>'btn btn-crop','onclick'=>'$("#crop1_'.$member->id.'").val("loading...");')//html options
            );
            ?><br />
            
                        
                        <a href="javascript:void(0)" class="btn btn-remove" onclick="return confirm_delete('Are you sure that you want to remove the image?'); "><span class="fa fa-times" style="color: #E00000;"></span> Remove</a><br />
                    </div>
                    <div class="clearfix"></div>
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
                <hr />
              
                <div class="form-group">
                    
                    <h2 class="col-md-12">Location <span class="grey">Required</span></h2>
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    <label class="col-md-2">Your Location <span class="required">*</span></label>
                     <div class="col-md-5">
                            <select name="province" class="form-control"  id="Member_province">
                                <option value="">Select Province</option>
                        <?php $provinces = Province::model()->findAll();
                            foreach($provinces as $province){?>
                                <option value="<?php echo $province->id;?>" <?php if($member->province==$province->id)echo "selected='selected'";?>><?php echo $province->name;?></option>
                        <?php }?>
                                
                            </select>
                            <br />
                            <span class="blue">Required for race personalisation- Optional</span>
                        </div>
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    <label class="col-md-2">City/Town</label>
                    <div class="col-md-9"><input type="text" class="form-control" placeholder="Your closest City or Town" name="suburb" value="<?php echo $member->suburb;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    <h2 class="col-md-12">Social Links <span class="grey">Optional</span></h2>
                    <div class="clearfix"></div>
                </div>
                <hr />
               <div class="form-group">
                    <div class="col-md-2">Facebook </div>
                    <div class="col-md-9">
                        <input type="url" class="form-control" placeholder="Input your Facebook username" name="facebook" value="<?php echo $member->facebook;?>" />
                        <br />
                        <span class="blue">http://www.facebook.com/</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    <div class="col-md-2">Twitter </div>
                    <div class="col-md-9">
                        <input type="url" class="form-control" placeholder="Input your Twitter username" name="twitter" value="<?php echo $member->twitter;?>" />
                        <br />
                        <span class="blue">http://www.twitter.com/</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <hr />
                 <div class="form-group">
                    <div class="col-md-2">Google + </div>
                    <div class="col-md-9">
                        <input type="url" class="form-control" placeholder="Input your Google+ username" name="google" value="<?php echo $member->google;?>" />
                        <br />
                        <span class="blue">http://www.google.com/</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    <h2 class="col-md-12">ID & Chip Numbers <span class="grey">Optional</span></h2>
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    <label class="col-md-12"><span class="blue">Tags your results.</span>We use this info to tag results to your profile.</label>
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    <label class="col-md-2">SA Identity No.</label>
                    <div class="col-md-9"><input type="text" class="form-control" placeholder="Your SA Identity Number" name="sa_identity_no"  value="<?php echo $member->sa_identity_no;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-9"><span class="blue">Input your <strong>SA Identity Number</strong> to track your results - <strong>Optional</strong></span></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
               
                    
                <?php $championchips = MemberExtra::model()->findAllByAttributes(['member_id'=>$member->id,'type'=>'championchip']);
                    if(count($championchips)>0)
                    {
                       foreach($championchips as $k=>$championchip)
                       { 
                        if($k==0)
                        {
                        ?>
                         <div class="form-group Championchip_Number">
                            <label class="col-md-2">Championchip</label>
                            <div class="col-md-7"><input type="text" class="form-control" placeholder="Your Championchip Number" name="championchip[]" value="<?php echo $member->championchip;?>" /></div>
                            <div class="col-md-2"><button type="button" class="add_chamionchip btn btn-outline-secondary" onclick="addmore('Championchip_Number','championchip');">ADD +</button></div>
                            <div class="clearfix"></div>
                         </div>
                        <?php }
                        else
                        {?>
                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-7"><input type="text" class="form-control" placeholder="Your Championchip Number" name="championchip[]" value="<?php echo $championchip->value;?>" /></div>
                            <div class="col-md-2"><input type="button" value="Remove" class="btn btn-danger" onclick="$(this).parent().parent().remove();"  /></div>
                            <div class="clearfix"></div>
                        </div>
                        <?php
                            
                        }?>
                    
                <?php
                        }
                    }
                    else
                    {
                    ?>
                        <div class="form-group Championchip_Number">
                        <label class="col-md-2">Championchip</label>
                        <div class="col-md-7"><input type="text" class="form-control" placeholder="Your Championchip Number" name="championchip[]" value="<?php echo $member->championchip;?>" /></div>
                        <div class="col-md-2"><button type="button" class="add_chamionchip btn btn-outline-secondary" onclick="addmore('Championchip_Number','championchip');">ADD +</button></div>
                        <div class="clearfix"></div>
                        </div>
                    <?php 
                    }?>
                    
                
                
                 <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-9"><span class="blue">Input your <strong>Championchip Number</strong> to track your results - <strong>Optional</strong></span></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                <?php $championchips = MemberExtra::model()->findAllByAttributes(['member_id'=>$member->id,'type'=>'tracetec']);
                        if(count($championchips)>0)
                        {
                           foreach($championchips as $k=>$championchip)
                           { 
                                if($k==0)
                                {
                                ?>
                                    <div class="form-group RaceTec_Number">
                                        <label class="col-md-2">RaceTec Chip</label>
                                        <div class="col-md-7"><input type="text" class="form-control" placeholder="RaceTec Number" name="tracetec[]" value="<?php echo $championchip->value;?>"  /></div>
                                        <div class="col-md-2"><button type="button" class="add_racetec btn btn-secondary" onclick="addmore('RaceTec_Number','tracetec');">ADD +</button></div>
                                        <div class="clearfix"></div>
                                    </div>
                                <?php
                                }
                                else
                                {
                                ?>
                                    <div class="form-group">
                                        <label class="col-md-2"></label>
                                        <div class="col-md-7"><input type="text" class="form-control" placeholder="RaceTec Number" name="tracetec[]" value="<?php echo $championchip->value;?>"  /></div>
                                        <div class="col-md-2"><input type="button" value="Remove" class="btn btn-danger" onclick="$(this).parent().parent().remove();"  /></div>
                                        <div class="clearfix"></div>
                                    </div>
                                <?php
                                }
                            }
                        }
                        else
                        {
                            ?>
                        <div class="form-group RaceTec_Number">
                            <label class="col-md-2">RaceTec Chip</label>
                            <div class="col-md-7"><input type="text" class="form-control" placeholder="RaceTec Number" name="tracetec[]" value="<?php echo $member->tracetec;?>"  /></div>
                            <div class="col-md-2"><button type="button" class="add_racetec btn btn-secondary" onclick="addmore('RaceTec_Number','tracetec');">ADD +</button></div>
                            <div class="clearfix"></div>
                        </div>
                        <?php    
                        }
                        ?>
                
                 <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-9"><span class="blue">Input your <strong>RaceTec Number</strong> to track your results - <strong>Optional</strong></span></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                <input type="submit" name="submit" value="Save Changes" class="btn btn-default bgblue btn-lg" />
                </div>
                
            </form>
            
        </div>
        <div class="clearfix"></div>
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
<!-- Rght side bar end --><?php */?>
    <script>
    function addmore(div,name)
    {
        $("."+div).prepend('<div class="form-group">'+
                        '<div class="col-md-2"></div>'+
                        '<div class="col-md-7"><input type="text" class="form-control" placeholder="'+div.replace("_",' ')+'" name="'+name+'[]" value="" /></div>'+
                        '<div class="col-md-2"><input type="button" value="Remove" class="btn btn-remove" onclick="$(this).parent().parent().remove();"  /></div>'+
                        '<div class="clearfix"></div>'+
                
                    '</div>');
        
    }
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
            /*CKEDITOR.replace( 'description' );
            CKEDITOR.editorConfig = function( config ) {
        	config.language = 'es';
        	config.uiColor = '#F5f5f5';
        	};
            function textCounter2(field, countfield, maxlimit)
            {
            	if (field.value.length > maxlimit) // if too long...trim it!
            		field.value=field.value.substring(0, maxlimit);
            	else  // otherwise, update counter
            		countfield.value=field.value.length;
            }
            var editor = CKEDITOR.instances.description;*/
            /*editor.on( 'key', function( evt ){
                alert(evt.editor.getData());
               // Update the counter with text length of editor HTML output.
               textCounter2( { value : evt.editor.getData() },this.form.grLenght2, 500 );
            }, editor.element.$ );
            var locked;*/
           
            /*editor.on( 'change', function( evt ){
                var html=editor.getData();
                var dom=document.createElement("DIV");
                dom.innerHTML=html;
                var plain_text=(dom.textContent || dom.innerText);
                var currentLength = plain_text.length,
                   maximumLength = 600;
                var rem_text = maximumLength-currentLength;
                $('.count_letter').text(rem_text);
                if( currentLength >= maximumLength )
                {
                     
                    //editor.execCommand( 'undo' );
                     setTimeout( function()
                     {
                        if(rem_text<0) 
                        {   var snippet=dom.innerText.substr(0,600);
                                editor.setData(snippet);} 
                        if( !locked )
                          {
                             // Record the last legal content.
                             editor.fire( 'saveSnapshot' ), locked = 1;
                                            // Cancel the keystroke.
                             evt.cancel();
                          }
                          else
                          {
                                setTimeout( function()
                                 {
                                    // Rollback the illegal one.  
                                    if( plain_text.length > maximumLength )
                                       editor.execCommand( 'undo' );
                                    else
                                       locked = 0;
                                 }, 0 );
                          }
                        },0);
            
                }
               });
            */
            
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
                    province: 'required',
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
                    sa_identity_no:{
                        remote:{
                            url:"<?php echo Yii::app()->request->baseUrl;?>/member/checkemail?type=sa_identity_no",
                            type: "post",
                            //data: { sa_identity_no: $.validator.format("{0}") }
                            }
                        
                    },
                    'championchip[]':{
                         remote:{
                            url:"<?php echo Yii::app()->request->baseUrl;?>/member/checkemail?type=championchip",
                            type: "post",
                            //data: { sa_identity_no: $.validator.format("{0}") }
                            }
                    },
                    'tracetec[]':{
                         remote:{
                            url:"<?php echo Yii::app()->request->baseUrl;?>/member/checkemail?type=tracetec",
                            type: "post",
                            //data: { sa_identity_no: $.validator.format("{0}") }
                            }
                    },
					
				},
                groups: {
                    y_ob: "d_ob m_ob y_ob"
                },
				messages: {
					fname: "Input a firs tname",
					lname: "Input a last name / Surname",
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
                	sa_identity_no: {
					    
                        remote: $.validator.format("'{0}' SA Identity No. is already used.")
                    },
                    'tracetec[]':{
                        remote: $.validator.format("'{0}' RaceTec number is already used.")
                    },
                    'championchip[]':{
                        remote: $.validator.format("'{0}' ChampionChip number is already used.")
                    },
					
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
