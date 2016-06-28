<?php if(Articles::countArticlesOfCompany()){ ?>
<h2 class="grey-bg">Articles By Company</h2>
<div class="margintopbot10 lists-new">
    <?php 
        foreach(Articles::countArticlesOfCompany() as $val){
            $count = Articles::model()->countArticlesByCompany($val->id);
            if(($count) !=0){?>
            <span class="brbyauthername"><?php
                echo CHtml::link($val->name, $this->createUrl('news/company/'.$val->slug));?> <span class="blue">(<?php echo $count;?>)</span></span>
    <?php }}?>
    <div class="clear"></div>
</div>
<?php } ?>