<div class="line"></div>
 <h2><strong>Organiser Details - <span class="blue">Complete the organiser details below.</span></strong></h2>
    <div class="line"></div>
   
    <div><?php
    echo CHtml::activeLabelEx($org,'title');
    echo CHtml::activeTextField($org,'title');
    echo CHtml::error($org,'title',array('class'=>'error'));?>
    </div>
    
    <div><?php echo CHtml::activeLabelEx($org,'contact_number');
    echo CHtml::activeTextField($org,'contact_number');
    echo CHtml::error($org,'contact_number');?>
    </div>
     
    <div><?php echo CHtml::activeLabelEx($org,'contact_email');
    echo CHtml::activeTextField($org,'contact_email');
    echo CHtml::error($org,'contact_email');?>
    </div>
    
    <div><?php echo CHtml::activeLabelEx($org,'website');
    echo CHtml::activeTextField($org,'website');
    echo CHtml::error($org,'website');
    ?> 
    </div>
    
    <div class="clear"></div>
    <script>
    $(document).ready(function(){
        $('#Organisers_title').blur(function(){
            check_if_empty('Organisers_title','Organiser');
        }); 
        
        $('#Organisers_contact_number').blur(function(){
            check_if_empty('Organisers_contact_number','Contact Number');
        });
        
        $('#Organisers_contact_email').blur(function(){
            check_if_empty('Organisers_contact_email','Contact Email');
          
        });
        
        $('#Organisers_title').keyup(function(){$('#Organisers_title_em').html('');});
        $('#Organisers_contact_number').keyup(function(){$('#Organisers_contact_number_em').html('');});
        $('#Organisers_contact_email').change(function(){$('#Organisers_contact_email_em').html('');});

        $('#Organisers_website').focus(function(){
            if($(this).val()=='')
                $(this).val('http://');
        }); 
        
        $('#Organisers_website').focusout(function(){
            if($(this).val()=='http://')
                $(this).val('');
        });
    });
    </script>