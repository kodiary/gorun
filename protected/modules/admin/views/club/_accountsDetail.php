<div class="restaurant_menus_wrapper">


<h2>Accounts - <span>Payment details for your listing</span></h2>
<div class="line"></div>
<?php 
if($status==1)// listing is  active
{
?>
    <div class="account-active">
    	<h2 style="margin-top: 0;">Account Status - <span>Your listing is ACTIVE and is displaying live</span></h2>
    </div>
<?php
}
else
{
?>
    <div class="account-inactive">
    	<h2>Account Status - <span>Your listing is NOT ACTIVE - Please contact accounts to pay</span></h2>
   </div>
<?php 
}
?>

<?php if($accounts){ ?>
    <div class="account_listing_forms">
        <?php echo $accounts->detail; ?>
    </div>
    
    <?php if($accounts->filename!='' && file_exists(Yii::app()->basePath.'/../documents/'.$file->filename)){ ?>
    <div class="account_downloads">
    	<span class="pdf_icons"></span>
    	<p><a class="" href="<?php echo $this->createUrl('/site/downloadOrderForm') ?>">Download Debit Order Form</a></p>
    	<a class="red_links" href="<?php echo $this->createUrl('/site/downloadOrderForm') ?>">Download</a>
    </div>
    
    <div class="clear"></div>
    <?php } ?>
<?php } ?>
</div>