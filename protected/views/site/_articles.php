<div class="directory_listing new-one">
<a href="<?php echo $this->createUrl('news/'.$data->slug);?>">
<article> 
<?php
if(Articles::get1ImageFromFile($data->id)->title)
    $alt = Articles::get1ImageFromFile($data->id)->title;
else
    $alt = $data->title;
?>
	<aside class="fl_left">
    	<div class="thumbnail left">
        <?php
        $baseUrl = Yii::app()->baseUrl;
        $basePath = Yii::app()->basePath;
        $img_url=$baseUrl.'/images/article_fallback_80x80.png';
        
        $filename=Articles::get1ImageFromFile($data->id);
        //get aritlce image if article image exists
        if(file_exists($basePath.'/../images/frontend/thumb/'.$filename) && $filename!="")
            $img_url=$baseUrl.'/images/frontend/thumb/'.$filename;

        echo  CHtml::image($img_url, $alt);  
        ?>
        </div>
    </aside><!--articleImage-->
    
    <aside class="right article_desc">
    <h2><?php echo $data->title;?></h2>
        <p class="desc"><span style="color: #205FAC;"><?php echo date('d F Y',strtotime($data->publish_date))?> - </span><?php echo CommonClass::limit_text($data->detail);?></p>
    </aside><!--articleContent-->
    <div class="clear"></div>
</article></a>
</div>
