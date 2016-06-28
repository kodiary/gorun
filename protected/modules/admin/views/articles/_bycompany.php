<div class="">
<!-- start right side bar-->
<div class="well">

    <h3>Articles By Company</h3>
    <ul>
    <?php
         foreach(Articles::countArticlesOfCompany() as $val){
            $count = Articles::model()->countArticlesByCompany($val->id);
                if(($count) !=0){ ?>
                    <li style="list-style:none; margin: 3px 0;">
                        <?php echo CHtml::link($val->name, $this->createUrl('articles/index/companyId/'.$val->id));?>
                        <span class="blue">(<?php echo $count;?>)</span>
                    </li>
            <?php }
         } ?>                    
    </ul>
</div>
<!-- end right side bar-->
</div>