<?php if($services = Services::getTaggedServices()){ ?>
<h1 class="service-heading">Service List</h1>
<h2 class="bluebg">List of Services Offered by Members</h2>
<div class="margintopbot10 lists-new-new">
<ul>
    <?php foreach($services as $data){
        $count = CompanyServices::countCompanyByService($data->id);
        if($count!=0){?>
        <li>
    	    <?php echo CHtml::link($data->service_name, $this->createUrl('directory/service/'.$data->slug));?>
            <span class="blue"> (<?php echo $count;?>)</span>
        </li>

    <?php }
    }?>
    </ul>
    <div class="clear"></div>
</div>
<?php } ?>