<?php if(Articles::getLatestArticles()){?>
<div class="latest-news">
<div class="titleBox">
<h2 class="left">LATEST NEWS</h2> <a href="<?php echo $this->createUrl('/news');?>" class="right">View More</a>
<div class="clear"></div>
</div>

<?php foreach(Articles::getLatestArticles() as $data){?>
<article class="relatedArticles">
	<figure class="articleImage left">
    	<a class="thumbnail" href="<?php echo $this->createUrl('news/'.$data->slug);?>">
        <?php
        $baseUrl = Yii::app()->baseUrl;
        $basePath = Yii::app()->basePath;
        $img_url=$baseUrl.'/images/article_fallback_70x70.png';
        
        $filename=Articles::get1ImageFromFile($data->id);
        //get aritlce image if article image exists
        if(file_exists($basePath.'/../images/frontend/thumb/'.$filename) && $filename)
            $img_url=$baseUrl.'/images/frontend/thumb/'.$filename;
        else //get author image
        {
            if($data->company_id>0)
            {
                $company=Company::companyInfo($data->company_id);
                if($company && $company->logo!="")
                {
                   if(file_exists($basePath.'/../images/frontend/thumb/'.$company->logo))
                    $img_url=$baseUrl.'/images/frontend/thumb/'.$company->logo; 
                }
            }
        }
        echo  CHtml::image($img_url, $alt);  
        ?>
        </a>
    </figure><!--articleImage-->
    
    <aside class="articleContent left">
    
         <p class="desc">
            <a href="<?php echo $this->createUrl('news/'.$data->slug);?>" ><?php echo CommonClass::limit_text($data->title);?></a>
         </p>

    </aside><!--articleContent-->
    <div class="clear"></div>
    </article>
    <div class="line" style="margin: 0;"></div>

 <?php }}?>
 <div class="more-new"><a href="" class="more">More<i class="icon-circle-arrow-right"></i></a></div>
 </div>