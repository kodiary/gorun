<h3 class="admin_top_list_headings">List of <span class="bold">Brands - Retag Brands</span></h3>
<div class="col-md-8 restaurant_menus_wrapper">
<form method="post">
<div class="well">
    <div class="control-group ">
        <label for="replace" class="control-label"><strong>Replace</strong></label>
        <div class="controls">
        <select id="replace" name="replace">
           <?php 
           if($additional)
           {
                foreach($additional as $val)
                {
                ?>
                <option value="<?php echo $val->id?>"><?php echo $val->brand_name?></option>
                <?php
                }
           }
           ?>
        </select>
        </div>
    </div>
    
    <div class="control-group">
        <label for="with" class="control-label"><strong>With</strong></label>
        <div class="controls">
        <select id="with" name="with">
           <?php 
           if($brands)
           {
                foreach($brands as $brand)
                {
                ?>
                <option value="<?php echo $brand->id?>"><?php echo $brand->brand_name?></option>
                <?php
                }
           }
           ?>
        </select>
        </div>
    </div>
    <div class="line"></div>
    <div><input type="submit" name="submit" value="SUBMIT" class="btn btn-primary"/></div>
    <div class="clear"></div>
</div>
</form>
<div class="clear"></div>
        
</div><!--#col-md-8-->

<div class="col-md-4">
    <div> <a class="btn" href="<?php echo $this->createUrl('/admin/brands');?>">Cancel</a></div>
</div><!--#col-md-4-->

<div class="clear"></div>