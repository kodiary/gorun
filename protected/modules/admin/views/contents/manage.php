<?php
$this->breadcrumbs=array(
	'Contents'=>array('manage'),
	'Manage',
);
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-ui.min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.noble.min.js');
?>
<script type="text/javascript">
jQuery(function($){
    $('#page-lists ul').sortable({
         items: "li:not(.ui-state-disabled)",
         update : function (event,ui) {
            var order=[];// array to hold the id of all the child li of the selected parent
            $('#'+ui.item.parent().attr('id')).children().each(function(index) {
                    var item=$(this).attr('id').split('_');
                    var val=item[1];
                    order.push(val); 
                });
            var itemList="list="+order;
            $("#showmsg").load("<?php echo $this->createUrl('sort');?>",itemList); 
         }
    });
});
</script>
<aside class="left_body floatLeft">
<div class="line"></div>
<h1>Pages -<span class="green"> List of pages </span></h1>
<div class="line"></div>
<p><em>Order - Drag and drop the page order.</em></p>

<?php
$pages = CHtml::listData($model, 'id', 'title');
if(is_array($pages))
{
    foreach($pages as $id=>$page)
    {
?>
    <ul id="parentPages">
    <li id="parent_item" class="pageManagerList greybg" style="font-size:17px; color:#333;">
    <div class="floatLeft margintop5"><?php echo ucwords($page);?></div>
    <div class="floatRight">
	<?php echo CHtml::link('Edit',array('/admin/contents/update/id/'.$id),array('class'=>'btn btn-info'))?>
	</div>
    <div class="clear"></div>
    </li>
    </ul>
<?php } ?>
<div id="page-lists">
    <?php
    foreach($pages as $id=>$page)
    {
        $criteria= new CDbCriteria;
        $criteria->condition = "parent=$id";
        $criteria->order='display_order ASC';
        $sub_pages=CHtml::listData(Contents::model()->findAll($criteria),'id','title');
    ?>
    <?php
    if(is_array($sub_pages))
    {
        ?>
        <ul id="subPages" >
        <?php
        foreach($sub_pages as $sub_id=>$sub_page)
        {
        ?>
        <li id="item_<?php echo $sub_id;?>"class="pageManagerList greybg" style="font-size:17px; color:#333;">
        
        <div class="floatLeft margintop5"> <?php echo ucwords($sub_page);?></div>
        <div class="floatRight">
        	<?php echo CHtml::link('Edit',array('/admin/contents/update/id/'.$sub_id.'_'.$id),array('class'=>'btn btn-info'))?>
        </div>
        <div class="clear"></div>
        
        </li>
        <?php
        }
        ?>
        </ul>
    <?php
    }
    ?>
    
    <?php
    }
    ?>
<?php
}
?>
<div id="showmsg"></div>
</div>
</aside>




<aside class="right_body floatRight" >
	<a href="<?php echo $this->createUrl('/admin/contents/create')?>" class="btn">+Add Page</a>
</aside>

<div class="clear"></div>