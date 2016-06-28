<h3 class="admin_top_list_headings">List of <span class="bold">Products - Retag Products</span></h3>
<div class="left_body restaurant_menus_wrapper">
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
                <option value="<?php echo $val->id?>"><?php echo $val->product_name?></option>
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
           if($products)
           {
                foreach($products as $data)
                {
                ?>
                <option value="<?php echo $data->id?>"><?php echo $data->product_name?></option>
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
        
</div><!--#left_body-->

<div class="right_body">
    <div> <a class="btn" href="<?php echo $this->createUrl('/admin/products');?>">Cancel</a></div>
</div><!--#right_body-->

<div class="clear"></div>