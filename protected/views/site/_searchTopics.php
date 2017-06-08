
<div class="gray_blocks round searchTopics">
	<h2 class="fl_left width65">Common Search Topics</h2>
    <span class="fl_right commonTopicsDownArrow"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/downarrow.png" alt="show"/></span>
    <span class="fl_right commonTopicsUpArrow" style="display: none;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/uparrow.png" alt="hide"/></span>
    <div class="clear"></div>
</div>
<?php 
$searchTopics = MostSearched::model()->getCommonSearchTopics();
$commonSearch = array();
if($searchTopics)
{
    foreach($searchTopics as $model)
    {
        if($model->product_id!=0)
        {
            $productModel = Products::model()->findByPk($model->product_id);
            if($productModel){
                $commonSearch[]=array('label'=>ucwords($productModel->product_name),'url'=>$this->createUrl('/products/'.$productModel->slug));
            }
        }
        elseif($model->service_id!=0)
        {
            $serviceModel = Services::model()->findByPk($model->service_id);
            if($serviceModel){
                $commonSearch[]=array('label'=>ucwords($serviceModel->service_name),'url'=>$this->createUrl('/services/'.$serviceModel->slug));
            }
        }
    }
}
?>
<div class="commonTopics" style="display: none;">
<?php
    $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', 
    'stacked'=>false, 
    'items'=>$commonSearch
    ));
?>
</div>


<script type="text/javascript">
/*<![CDATA[*/
$(document).ready(function(){
    $('.commonTopicsDownArrow').click(function(){
       $('.commonTopics').show();
       $('.commonTopicsDownArrow').hide();
       $('.commonTopicsUpArrow').show();
    });
    $('.commonTopicsUpArrow').click(function(){
       $('.commonTopics').hide();
       $('.commonTopicsDownArrow').show();
       $('.commonTopicsUpArrow').hide();
    });
});
/*]]>*/
</script>