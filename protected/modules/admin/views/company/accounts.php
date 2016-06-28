<?php echo $this->renderPartial('_companyHeader', array('model'=>$company));?>
<div class="company-bottom">
<div class="left_body">
<?php $this->renderPartial('_accountsDetail',array('status'=>$status,'model'=>$company,'accounts'=>$accounts));?>    
</div>
<div class="clear"></div>
</div>