<!-- featured products and services -->
<div id="featuredInfo" style="display: none;">
    <?php
    if($featured)
    {
    ?>
    <div class="tryourmealsDiv">
    <h2 class="border_tagLine">Featured Products or Services</h2>
    <ul>
    <?php
        foreach($featured as $ft)
        {
            if($ft->image!="" && file_exists(Yii::app()->basePath.'/../images/frontend/main/'.$ft->image))
            {
              $featured_img_url = Yii::app()->baseUrl."/images/frontend/main/".$ft->image; 
            } 
            else
            {
               $featured_img_url = Yii::app()->baseUrl."/images/featuredFallback.png";  
            }
        ?>
        <li id="<?php echo CommonClass::getSlug($ft->title);?>">
        	<div class="fl_left ftdImg">
            	<div class="img_holder thumbnail">
                    <img src="<?php echo $featured_img_url?>" alt="" width="200"/>
            	</div>
            </div>
            <div class="fl_left ftxt">
            	<h3><?php echo ucwords($ft->title); ?></h3>
        		<p><?php echo ($ft->detail);?></p>
                <script type="text/javascript">
                //<![CDATA[
                    document.write('<div class="fb-like" data-href="<?php echo 'http://'. Yii::app()->getRequest()->serverName.Yii::app()->request->requestUri."#".CommonClass::getSlug($ft->title);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>');
                //]]>
                </script>
                <div class="clear"></div>
        	</div>
            <div class="clear"></div>
       </li>
        <?php
        }
    ?>
    </ul>
    </div>
    <?php
    }
    ?>
</div>
<!-- featured products and services end-->