<div class="well">
    <h3>SEO BY PAGE</h3>
    <ul>
    <?php
        $seo = Seo::model()->findAll();
        foreach($seo as $val)
        {
            ?>
            <li><?php echo CHtml::link($val->PageTitle,array('/admin/seo/update/id/'.$val->SeoId))?></li>    
            <?php
        }
    ?>
        <li><?php echo CHtml::link('Company Page',array('/admin/seo/updateCompany'))?></li>
    </ul>
</div>