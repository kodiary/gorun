<div class="sidebar col-md-3">
  <?php echo $this->renderPartial('/sidebar/_menu', false, true); ?>
</div>
<div class="col-md-7 right-content profile_detail">
  <div class="col-md-12">
        <h1>YOUR CLUB</h1>
        Clubs you are member of. To add a club, simply follow them from the club page.
    </div>
    <div class="clearfix"></div>
    <hr />
<?php 
//var_dump($clubs);
foreach($clubs as $club)
{
   
    ?>
    <div class="col-md-12 clubs">
    <?php echo ucfirst($club->title);?>
    <a href="#"><span class="glyphicon glyphicon-remove right" aria-hidden="true"></span></a>
    </div>
<?php
}
?>
 <hr />
</div>
<div class="clearfix"></div>