<?php echo $this->renderPartial('_companyHeader', array('model'=>$company));?>
<div class="company-bottom">
<div class="col-md-8">
<?php $this->renderPartial('_accountsDetail',array('status'=>$status,'model'=>$company,'accounts'=>$accounts));?>    
</div>
<div class="clear"></div>
</div>