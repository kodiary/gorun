<div id="aboutInfo" style="display: none;">
    <div id="about">
    <div class="line"></div>
    	<?php if($model->tagline!=""){?><h2 class="rockwell"><?php echo $model->tagline;?></h2><?php } ?>
        <div class="line"></div>
      	<div class="description_taglines"><?php echo nl2br($model->detail);?></div>
       <?php 
          $services=$model->services;
          if($services)
          {
            ?>
            <div class="line"></div>
            <h2 class="rockwell">Our Services Include:</h2>
            <div class="line"></div>
            <ul>
            <?php
            foreach($services as $service)
            {
            ?>
            <li><?php echo Services::model()->findByPk($service->service_id)->service_name;?></li>
            <?php
            }
            ?></ul><?php
          }
          ?>
          
    </div>  
<!-- about end -->
</div>