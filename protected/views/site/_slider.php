<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/rs-plugin/responsive.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/rs-plugin/css/settings.css" media="screen"  />

 <!-- REVOLUTION BANNER JS FILES  -->
<script src="<?php echo Yii::app()->baseUrl.'/js/rs-plugin/js/jquery.themepunch.plugins.min.js'?>" type="text/javascript"></script>
<script src="<?php echo Yii::app()->baseUrl.'/js/rs-plugin/js/jquery.themepunch.revolution.min.js'?>" type="text/javascript"></script>

<?php
if($sliders)
{
?>
   <div class="bannercontainer" >
        <div class="banner">
        <ul>
        <?php
        foreach($sliders as $data)
        { 
            if(file_exists(Yii::app()->basePath.'/../images/frontend/main/'.$data->image) && $data->image)
            {
                $img_url=$this->createUrl('/images/frontend/main/'.$data->image);
                if($data->target==1)$target="_blank"; else $target="";
                $transition=array(
                        'boxslide',
                        'boxfade',
                        'slotzoom-horizontal',
                        'slotslide-horizontal',
                        'slotfade-horizontal',
                        'slotzoom-vertical',
                        'slotslide-vertical',
                        'slotfade-vertical',
                        'curtain-1',
                        'curtain-2',
                        'curtain-3',
                        'slideleft',
                        'slideright',
                        'slideup',
                        'slidedown',
                        'fade',
                        'flyin',
                        'cubic',
                        'turnoff',
                        '3dcurtain-horizontal',
                        '3dcurtain-vertical',
                        'papercut'
                );
                $t_size=count($transition);
                $t_index=rand(0,$t_size);
            ?>
            
            <li
            <?php if($data->slide_link!=""){?> data-link="<?php echo $this->createUrl('/site/slider/id/'.$data->id)?>"<?php } ?>
            <?php if($data->transition!="" && $data->transition!='random'){?> data-transition="<?php echo $data->transition?>"<?php }else{?> data-transition="<?php echo $transition[$t_index];?>"<?php } ?>
            <?php if($data->slot_amount!='' && $data->slot_amount>0){?> data-slotamount="<?php echo $data->slot_amount?>"<?php } ?>
             data-target="$target">
                <img src="<?php echo $img_url;?>"/>
                <?php if($data->caption!=""){?>
                    <div class="caption sft medium_text "  
                            data-x="10" 
                            data-y="135" 
                            data-speed="1000" 
                            data-start="800" 
                            data-easing="easeOutExpo"><?php echo strtoupper($data->caption);?>
                    </div>
                <?php }?>
                
                <?php if($data->sub_caption!=""){?>
                    <div class="caption sft medium_text "  
                            data-x="10" 
                            data-y="177" 
                            data-speed="1000" 
                            data-start="1000" 
                            data-easing="easeOutExpo"><?php echo strtoupper($data->sub_caption);?>
                    </div>
                <?php }?>
            </li>
            <?php
            }
        }
        ?>
        </ul>
        <!--loading bar-->
        <!--<div class="tp-bannertimer tp-bottom"></div>-->
        </div>
    </div>
<?php
}
?>

<script type="text/javascript">
	var tpj=jQuery;
	tpj.noConflict();

	tpj(document).ready(function() {

	if (tpj.fn.cssOriginal!=undefined)
		tpj.fn.css = tpj.fn.cssOriginal;

		tpj('.banner').revolution(
			{
				delay:5000,
				startheight:270,
				startwidth:980,

				hideThumbs:200,

				thumbWidth:100,							// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
				thumbHeight:50,
				thumbAmount:5,

				navigationType:"bullet",				// bullet, thumb, none
				navigationArrows:"solo",				// nexttobullets, solo (old name verticalcentered), none

				navigationStyle:"none",				// round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom

				navigationHAlign:"center",				// Vertical Align top,center,bottom
				navigationVAlign:"top",					// Horizontal Align left,center,right
				navigationHOffset:0,
				navigationVOffset:20,

				soloArrowLeftHalign:"left",
				soloArrowLeftValign:"center",
				soloArrowLeftHOffset:20,
				soloArrowLeftVOffset:0,

				soloArrowRightHalign:"right",
				soloArrowRightValign:"center",
				soloArrowRightHOffset:20,
				soloArrowRightVOffset:0,

				touchenabled:"on",						// Enable Swipe Function : on/off
				onHoverStop:"on",						// Stop Banner Timet at Hover on Slide on/off

				stopAtSlide:-1,							// Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
				stopAfterLoops:-1,						// Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic

				hideCaptionAtLimit:0,					// It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
				hideAllCaptionAtLilmit:0,				// Hide all The Captions if Width of Browser is less then this value
				hideSliderAtLimit:0,					// Hide the whole slider, and stop also functions if Width of Browser is less than this value

				shadow:0,								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
				fullWidth:"off"							// Turns On or Off the Fullwidth Image Centering in FullWidth Modus
			});
		});
</script>