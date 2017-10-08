<div class="col-md-8">
<div class="line"></div>
<h1>Last 21 Log-ins</h1>
<div class="line"></div>

<?php
if(Yii::app()->controller->action->id!='newlisting')
{
?>
<!--ul class="admin_top_navs">
    <li><strong>Last 21 Log-ins</strong></li>
</ul-->
<?php
}
else
{
?>
<h2 class="s_header">New Listings</h2>
<?php
}
?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<?php
foreach($memberlogins as $m)
{
    $li = "<b>".$m->member['fname']." ".$m->member['lname']."</b> - ".$m->member['email']." - <a href='".$this->createUrl('members/update/id/'.$m->member['id'])."' class='blue'>Last Login ".date('d F Y * H:i',strtotime($m->login_date))."</a>";
    echo str_replace("*",'at',$li);
    echo "<hr/>";
}
?>
</div>

<div class="col-md-4">

<?php $this->renderPartial('_search');?>


</div>
<div class="clear"></div>