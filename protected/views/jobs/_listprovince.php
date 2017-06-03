<div class="job-finder">
<h2>Job Finder</h2>
<?php
$province = Province::model()->findAll();

if($province){
    ?>
    <ul>
    <?php foreach($province as $p)
    {
        $count=Jobs::model()->countJobsByProvince($p->id);?>
        <li><a href="<?php echo $this->createUrl("jobs/province/".$p->slug);?>"><?php echo $p->name." (".$count.")";?></a></li>
    <?php }?>
    <div class="clear"></div>
    </ul>
<?php }
?>
</div>