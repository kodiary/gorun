 <div class="line"></div> 
 <h2>Venue Details - <span class="blue">Complete the venue details below.</span></h2>
 	
    <div class="line"></div>
    <?php
    if(!isset($venue->country))
    	$venue->country = 'ZA';
        echo CHtml::activeLabelEx($venue,'country');
    	$countries = Country::model()->findAll();
    	foreach($countries as $c)
    	{
    		$country_drop_down[$c->twoLetterISOCode]=$c->countryName;
    	
    	}
    	echo CHtml::activeDropDownList($venue,'country',$country_drop_down,array('prompt'=>'--Select Country--','id'=>'Venues_country','selected'=>'','onchange'=>'changecountry(this.value);'));
    ?>
<div class="line"></div>
    <?php /*?><div>Venue Name  <input type="text" name="Venues[title]" class="span5" value="<?php echo ($venue_detail)?$venue_detail->title:"";?>"/></div><?php */?>
    
    <?php echo CHtml::activeLabelEx($venue,'title');
    echo CHtml::activeTextField($venue,'title');?>
    <div class="line"></div>
    <h2>Venue Map - <span class="blue">Optional physical location of venue.</span></h2>
    <div class="line"></div>

    <?php
    $regions = Province::model()->findAll();
    foreach($regions as $region)
    {
        $drop_down_region[$region->id]=$region->name;
    }
    
    echo CHtml::activeLabelEx($venue,'address');
    echo CHtml::activeTextField($venue,'address',array('class'=>'span4','id'=>'streetAdd'));
    
    echo CHtml::activeLabelEx($venue,'city');
    echo CHtml::activeTextField($venue,'city',array('class'=>'span4','id'=>'city','onblur'=>"codeAddress();",'placeholder'=>'Suburb, town or city'));
    ?><div class='province' <?php if(isset($venue->country)=='ZA')echo "style='display:none;'";?>>
    <?php
    echo CHtml::activeLabelEx($venue,'region');
    echo CHtml::activeDropDownList($venue,'region',$drop_down_region,array('prompt'=>'--Select Province--','id'=>'Venues_region','onchange'=>'codeAddress();'));
    ?>
    </div>
    <div class="line"></div>
    <div class="control-group">
    	<h2>Coordinates</h2>
     <div class="line"></div>
        <div class="controls">
        <div class="sn_group">
        	<div class="s1"> <?php
               echo CHtml::activeTextField($venue,'latitude',array('id'=>'Venues_Latitude', 'placeholder'=>'Latitude')); 
            //echo $form->textField($venue,'latitude',array('class'=>'span4','id'=>'Venues_Latitude', 'placeholder'=>'Latitude'));?><?php //echo $form->textField($venue, 'latitude',array('placeholder'=>'Latitude','style'=>'width:127px;','onBlur'=>'updateMapPinPosition();') );?></div>
            <div class="s2"> <?php  
                echo CHtml::activeTextField($venue,'longitude',array('id'=>'Venues_Longitude', 'placeholder'=>'Longitude')); 
            //echo $form->textField($venue,'longitude',array('class'=>'span4','id'=>'Venues_Longitude', 'placeholder' =>'Longitude'));?>
            <div class="clear"></div>
         </div>
        </div>
    <?php
    
    //echo $form->textFieldRow($venue,'address',array('class'=>'span4'));
    ?>
    <!-- gmap -->
    <div id="map_canvas" style="width: 600px; height: 300px;"></div>
    <h2 style="margin-top:5px;"><span>Drag the pin to reposition it if necessary</span></h2>
    <!-- gmap ends -->
    
    </div>
    <div class="clear"></div>
    </div>
    
    <script>
    function changecountry(c){
    	
    	if(c =='ZA')
        $('.province').show();
        else{
        $('.province').hide();
        $('#Venues_region').val('1');}
        
    }
    $(document).ready(function(){
        var country = $('#Venues_country').val();
        /*function is_empty(elem,name)
        {
            
            if($('#'+elem).val()=="")
            {
                if($('#'+elem).length>0){$('#'+elem+'_em').remove();}
                $('#'+elem).after('<div id="'+elem+'_em">'+name+' required!</div>');
            }
        }*/
        
        $('#Venues_title').blur(function(){
            check_if_empty('Venues_title','Venue Name');
        });
        
        $('#streetAdd').blur(function(){
            check_if_empty('streetAdd','Street Address');
        }); 
        $('#city').blur(function(){
            check_if_empty('city','City');
        });
        if(country== 'ZA'){
        $('.province').show();
        $('#Venues_region').blur(function(){
            check_if_empty('Venues_region','Province');
        });
        }
       
       $('#Venues_title').keyup(function(){$('#Venues_title_em').html('');});
       $('#streetAdd').keyup(function(){$('#streetAdd_em').html('');});
       $('#city').keyup(function(){$('#city_em').html('');});
       $('#Venues_region').change(function(){$('#Venues_region_em').html('');});
       
    });
    </script>