<?php if(Tags::fetchAllTags('tag')){ ?>
<h2 class="bluebg">Browse Articles By Topics</h2>
<div class="margintopbot10 lists-new" style="margin-bottom: 20px;">
    <?php foreach(Tags::fetchAllTags('tag') as $val){
        $count = Articles::countArticlesByTags($val->id);
        if($count!=0){?>
        <span class="brbyauthername">
    	    <?php 	
            echo CHtml::link($val->tag, $this->createUrl('news/tag/'.$val->slug));?>
            <span class="blue"> (<?php echo $count;?>)</span>
        </span>

    <?php }
    }?>
    <div class="clear"></div>
</div>
<?php } ?>