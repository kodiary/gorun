<div class="directory_listing new-one">
<a href="<?php echo $this->createUrl('news/'.$data->slug);?>">
<article class="news_article"> 
<?php
if(Articles::get1ImageFromFile($data->id)->title)
    $alt = Articles::get1ImageFromFile($data->id)->title;
else
    $alt = $data->title;
?>
	<aside class="col-md-2">
    	<div class="thumbnail left">
        <?php
        $baseUrl = Yii::app()->baseUrl;
        $basePath = Yii::app()->basePath;
        $img_url=$baseUrl.'/images/article_fallback_120x120.png';
        
        $filename=Articles::get1ImageFromFile($data->id);
        //get aritlce image if article image exists
        if(file_exists($basePath.'/../images/frontend/thumb/'.$filename) && $filename!="")
            $img_url=$baseUrl.'/images/frontend/thumb/'.$filename;

        echo  CHtml::image($img_url, $alt);  
        ?>
        </div>
    </aside><!--articleImage-->
    
    <aside class="col-md-10 article_desc">
    <strong><?php echo $data->title;?></strong>
        <p class="desc"><span style="color: #205FAC;"><?php echo date('d F Y',strtotime($data->publish_date))?> - </span><?php echo CommonClass::limit_text($data->detail);?></p>
    </aside><!--articleContent-->
    <div class="clearfix"></div>
</article></a>
</div>
