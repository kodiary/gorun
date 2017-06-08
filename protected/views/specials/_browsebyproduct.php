<?php
$sql = "SELECT id, product_name as name, slug, 'product' as section
        FROM `tbl_products`
        UNION 
        SELECT id, service_name as name, slug, 'service' as section
        FROM `tbl_services`
        ORDER BY name ASC";

$models=Products::model()->findAllBySql($sql);
if($models)
{
?>
<div class="search_by_prov" style="margin-bottom:10px;">
<h2><span class="blue">Browse by Product or Service</span></h2>
<ul>
<?php
    foreach($models as $model)
    {
        if($model->section=='product')
        {
            $url = $this->createUrl('/specials/product/'.$model->slug);
            $count = CompanySpecials::getSpecialsCountByProduct($model->id);
        }
        else
        {
            $url = $this->createUrl('/specials/service/'.$model->slug); 
            $count = CompanySpecials::getSpecialsCountByService($model->id);
        }
        if($count>0)
        {
    ?>
        <li><a href="<?php echo $url; ?>"><?php echo ucwords($model->name);?> <span class="blue">(<?php echo $count;?>)</span></a></li>
    <?php
        }
    }
?>
</ul>
<div class="clear"></div>
</div>
<?php
}
?>