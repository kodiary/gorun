<h2>Club finder</h2>
<div class="filter">
    <div class="fil-group">
    <a href="javascript:void(0)" class="fil searcheventType">Club type<span class="fa fa-sort"></span></a>
    <ul class="option">
    <?php  
    $eventsType = EventsType::model()->findAll();
    foreach($eventsType as $event)
    {
    ?>
        <li><a href="javascript:void(0);"><?php echo $event->title;?></a></li>
    <?php
    }
    ?>
    
    </ul>
    </div>
    <div class="fil-group">
        <a href="javascript:void(0)" class="fil searchProvince">All Provinces<span class="fa fa-sort"></span></a>
        <ul class="option">
        <?php $provinces = Province::model()->findAll();
            foreach($provinces as $province){?>
                <li value="<?php echo $province->id;?>"><a href="javascript:void(0);"><?php echo $province->name;?></a></li>
        <?php }?>
        </ul>
    </div>

    <div class="gap"></div>
    <a href="javascript:void(0)" class="btn btn-inverse btn-lg find">Search</a>
</div>
<?php
foreach($provinces as $prov)
{?>

    <a href="<?php echo Yii::app()->baseUrl;?>/clubs/type/<?php echo (isset($type))?$type:'';?>?province=<?php echo $prov->slug;?>" class="province-list <?php echo (isset($prov_id)&& $prov_id==$prov->id)?'province-active':'';?>"><?php echo $prov->name;?> <span class="pink"><?php echo Club::model()->countByProvince($prov->id);?></span></a>
<?php }?>
<a href="<?php echo Yii::app()->request->baseUrl;?>/clubs" class="submit-event">Add your Club &nbsp; <span class="fa fa-plus"></span></a>

<script>
$(function(){
    $('.find').click(function(){
        var type = $('.searcheventType').text();
        
        var province = $('.searchProvince').text();
        //alert(province);
        if(type == 'Club type')
            type='';
        else
            type =type.replace(' ','_');
        if(province =='All Provinces')
            province='';
        else
            province ='?province='+province.replace(' ','-');
       window.location="<?php echo Yii::app()->request->baseUrl;?>/clubs/type/"+type+province;
        });
})

</script>