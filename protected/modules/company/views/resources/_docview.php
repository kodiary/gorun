<?php            
    if($data->filename!="" && file_exists(Yii::app()->basePath.'/../documents/'.$data->filename))
    {
       $doc_name=($data->title!="")?$data->title:reset(explode('.',$data->filename));
       $doc_size= CommonClass::format_file_size(filesize(Yii::app()->basePath.'/../documents/'.$data->filename));
       $label=  "<strong>Document name - </strong> ".$doc_name.".".end(explode('.',$data->filename)).' ('.$doc_size.')';?>
      <?php
      //$doc_download_link = 'downloads/'.$doc_name;
      $doc_download_link = $this->createUrl('/site/savedoc/title/'.$doc_name.'/filename/'.urlencode($data->filename));
      $doc_download = "<span class='downloadDoc'><a target='_blank' href='".$doc_download_link."' style='position:absolute; top:24px; right:75px; font-size:12px;' class='btn'>Download</a></span>";
        echo "<section class='articleDocs'>";
        echo CHtml::ajaxLink($label,
                    CController::createUrl('/site/viewDoc', array(
                                                    'url'=>urlencode(Yii::app()->request->hostInfo.'/documents/'.$data->filename), 
                                                    'title'=>$doc_name.$doc_download,
                                                    //'model'=>'Resources',
                                                    //'id'=>$data->id
                                                    )
                                            ),
                    array('success'=>'function(data){$("#docPopup").html(data).dialog("open");}'),
                    array('id'=>'showDoc'.uniqid(), 'class'=>'articleDocument')
        );
        echo "</section>";
    }
?>