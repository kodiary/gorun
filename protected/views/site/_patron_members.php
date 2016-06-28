<script src="<?php echo Yii::app()->baseUrl.'/js/jquery.innerfade.js'?>" type="text/javascript"></script>
<script type="text/javascript">
var tps=jQuery;
	tps.noConflict();
tps(document).ready(
	function(){
		tps('ul#patronslider').innerfade({
			speed: 1000,
			timeout: 5000,
			type: 'sequence',
			containerheight: '220px'
		});
});
</script>
<?php if($patronslider){ ?>
      <div class="patron-member">EXSA PATRON MEMBERS</div>
        <ul id="patronslider">
        <?php
        foreach($patronslider as $data)
        { 
            if(file_exists(Yii::app()->basePath.'/../images/frontend/main/'.$data->image) && $data->image)
            {
                $img_url=$this->createUrl('/images/frontend/main/'.$data->image);
                if($data->target==1)$target="_blank"; else $target="";
            ?>
            <li>
            <?php if($data->slide_link!=''){ ?>
                <a href="<?php echo $this->createUrl('/site/slider/id/'.$data->id.'/type/patron')?>" target="<?php echo $target;?>"><img src="<?php echo $img_url;?>" width="360" height="260"/></a>
            <?php }else{ ?>
                <img src="<?php echo $img_url;?>" />
            <?php } ?>
                
            </li>
            <?php
            }
        }
        ?>
        </ul>
<?php } ?>