<div class="s_height_d">
    <div class="col-md-8">
    <div class="line"></div>
       <div class="companyList " style="margin:10px 0 0 0;">	
        	<div class="home left" > <a style="padding: 6px; margin-right: 10px;" href="<?php echo $this->createUrl('/admin/company');?>" class="btn"><i class="icon-home"></i></a> </div>
            <div class="blue_selects">
                <select onchange="if (this.value) window.location.href=this.value">
                <option value="">Select Company</option>
                <?php
                $companyList = Company::getAllCompany();
                if($companyList)
                {
                    foreach($companyList as $val)
                    {?>
                        <option value="<?php echo $this->createUrl('/admin/company/update/id/'.$val->id);?>" <?php if($val->id==$model->id) echo "selected";?>><?php echo $val->name;?></option>
                    <?php }    
                }
                ?>
                </select>
            </div>
            <div class="clear"></div>
       </div> 
     
    <!--dropdown menu end-->
        <div class="border-line pad15">
            <p class="f17"><?php echo ucwords($model->name); 
            if($model->date_updated!=null){?><span class="blue" style="display: inline-block; margin-top: 0;">&nbsp;</span>- Last Updated on <?php echo date('d F Y',strtotime($model->date_updated))?></span><?php } ?>
            </p>
        </div>
        <div class="gray_blocks borders active_or_not">
       	<div class="inner_gray_blocks tophdradmin">
           
           <?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
        	   'type'=>'horizontal',
               'enableAjaxValidation'=>false,
               'method'=>'post',
               'htmlOptions'=>array('id'=>'updateStatus'),
            )); 
            ?>
            <div class="fl_left lft">
            <?php echo $form->radioButtonListRow($model, 'status', array(
                1=>'Is ACTIVE and displays live to public',
                0=>'Is NOT ACTIVE and is hidden from public',
            )); ?>
            </div>
            <div class="clear"></div>
            <div class="control-group"><label class="control-label" style="width: 160px; padding-top: 0; color:#000;" >Stats</label><span class="blue control">Added <?php echo date('d F Y').' - Total Logins :'.$model->total_logins;?></span></div>
            
            <div class="line"></div>
            <div class="sub_margin" style="padding-bottom:10px;">
                <?php echo CHtml::ajaxSubmitButton('Submit',
                        $this->createUrl('company/updatestatus/id/'.$model->id),
                         array( //ajax options
                        'success'=>"js:function(data){
                                    $('#msg').html(data);
                                        /*if($('#Company_rigger_0').is(':checked'))
                                        {
                                            $('#branches').hide();   
                                            $('#featured').hide(); 
                                            $('#brochures').hide();      
                                            $('#specials').hide();       
                                        }
                                        else
                                        {
                                            $('#branches').show();   
                                            $('#featured').show(); 
                                            $('#brochures').show();      
                                            $('#specials').show();    
                                        }*/
                                    }",
                        'complete'=>"js:function(){
                                     $('#submitActive').val('Submit');
                                    }",
                        ),
                        array('id'=>'submitActive','class'=>'btn btn-primary btn-large','onclick'=>'js:$(this).val("Saving...")')//html options
                   );?>
            </div>
            <?php $this->endWidget();?>
           </div>
    </div>
    </div>
    <div class="col-md-4 memtype">
        <div class="fl_right" style="margin-left:5px;">
            <a class="btn" href="<?php echo $this->createUrl('company/contact/id/'.$model->id); ?>">Contact</a>
        </div>
        <div class="clear"></div>
        <div class=" border-line pad15"><p class="f17">Member Type</p></div>
        <div class="gray_blocks borders">
        
           <?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
        	   'type'=>'horizontal',
               'enableAjaxValidation'=>false,
               'method'=>'post',
               'htmlOptions'=>array('id'=>'updateMember'),
               'action'=>array('company/updateMemberType/id/'.$model->id),               
            ));
            $typeModel= new CompanyMember;
            $typeModel->member_id=$typeModel->getMemberByCompany($model->id);
            ?>
            <div class="pad10">
            <?php echo $form->checkBoxList($typeModel,'member_id',MemberType::listMembers());?>
            <div class="clear"></div>
            </div>
            
            <div class="line" style="margin-top: 33px;"></div>
            <div style="margin: 10px 0 0 10px;">
                <?php /* echo CHtml::ajaxSubmitButton('Submit',
                        $this->createUrl('company/updateMemberType/id/'.$model->id),
                         array( //ajax options
                        'success'=>"js:function(data){
                                    $('#msg').html(data);
                                    }",
                        'complete'=>"js:function(){
                                     $('#submitMemtype').val('Submit');
                                    }",
                        ),
                        array('id'=>'submitMemtype','class'=>'btn btn-primary btn-large','onclick'=>'js:$(this).val("Saving...")')//html options
                   );
                   */?>
                   <?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary btn-large')); ?>
            </div>
            <?php $this->endWidget();?>
        </div>
    </div>
    <div class="clear"></div>
        
</div>

<div class="line"></div>

<?php $this->widget('CompanyMenu')?>

<div class="line"></div>

<script>
$(document).ready(function(){
    $('#Company_valid_until').attr('disabled', $('#Company_never_expire_0').is(":checked"));
    if($('#Company_rigger_0').is(':checked'))
    {
        $('#branches').hide();   
        $('#featured').hide(); 
        $('#brochures').hide();   
        $('#specials').hide();       
    }
   $('#Company_never_expire_0').click(function(){
        $('#Company_valid_until').attr("disabled", $(this).is(":checked"));
   });
});
</script>