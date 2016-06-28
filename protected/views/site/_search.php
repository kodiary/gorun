<?php
$countries=Countries::model()->findAll();
$sql = "SELECT id, product_name as name, slug, 'product' as section
        FROM `tbl_products`
        UNION 
        SELECT id, service_name as name, slug, 'service' as section
        FROM `tbl_services`
        ORDER BY name ASC";

$products=Products::model()->findAllBySql($sql);
?>
<div class="bluebg">
<form action="<?php echo $this->createUrl('/')?>" id="companySearchForm" method="post">
    
        <label class="control-label">Country </label>
        <div class="controls">
        <select name="country" id="country">
        <!--<option value="">Select Country</option>-->
        <?php 
        $country=$_GET['country'];
        if($country=='')$country='south-africa';
        foreach($countries as $data)
        {
        ?>
            <option value="<?php echo $data->slug;?>" <?php if($country==$data->slug)echo "selected";?>><?php echo $data->name;?></option>
        <?php
        }
        ?>
        </select>
    </div>
    <div class="clear"></div>
    
    <label class="control-label">Product / Service</label>
    <div class="controls">
    <select name="product" id="product">
    <option value="">All</option>
    <?php 
        foreach($products as $data)
        {
        ?>
            <option value="<?php echo $data->slug;?>" <?php if($_GET['product']==$data->slug)echo "selected";?>><?php echo $data->name;?></option>
        <?php
        }
        ?>
    </select>
    </div>
    <input type="submit" name="btnsubmit" value="SUBMIT" class="btn btn-primary fl_left" onclick="return check();" style="margin-left:15px;"/>
    <div class="clear"></div>
    
</form>
</div>
<div class="bluebg orsearch">
<form action="<?php echo $this->createUrl('/search')?>">
    <label class="control-label">OR Search </label><div class="controls"><input type="text" name="keyword" id="searchKeyword" Placeholder="Keyword Search or Directory"/></div>
    <input type="submit" name="submit" value="SEARCH" class="btn btn-primary" style="float:left; margin-left:15px;" onclick='if($("#searchKeyword").val()=="") return false;'/>
    <div class="clear"></div>
</form>
</div>
<script type="text/javascript">
//<![CDATA[
var url='<?php echo $this->createUrl('/')?>';
function check()
{
    var country=$('#country').val();
    var product= $('#product').val();
    if(country!="")url+='/country/'+country;
    if(product!="")url+='/product/'+product;
    $('#companySearchForm').attr('action',url);
    $('#companySearchForm').find('select,input').attr('disabled', true);
    //document.getElementById ('companySearchForm').submit();
    $('#companySearchForm').submit();
}
//]]>
</script>
