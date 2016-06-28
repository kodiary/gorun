<?php 
    $seo = CommonClass::getSeoByPage('generic');
    $this->pageTitle = "News Approval - ".$seo['title'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index,nofollow"/>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/front_style.css" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <div class="container" id="page">
    <div class="approval">
        <?php
        if($status=='invalid')
        { ?>
            <div class="approval-box">Approval link is not longer valid and the article is either posted live or deleted.</div>
        <?php
        } elseif($status=='approved'){ ?>
            <div class="com-info">
                <?php $company = Company::model()->findByPk($model->company_id); ?>
                <p>Company: <?php echo $company->name; ?></p>
                <p>Article Number #<?php echo $model->id; ?></p>
                <p>Title: <?php echo $model->title; ?></p>
            </div>
            <div class="line"></div>
            <div class="approval-box" style="text-align: left;" >Done. Approval link deleted and company has been notified.</div>
        <?php } elseif($status=='rejected'){ ?>
            <div class="approval-box">Done. Article has been successfully deleted.<br/>Approval link deleted and company has been notified.</div>
        <?php } else {
            $this->renderPartial('_approval',array('model'=>$model));
        } ?>
        </div>
    </div>
<script>
$(document).ready(function()
    {
        $('.articleVideo iframe').each(function()
        {
               var url = $(this).attr("src");
                var char = "?";
              if(url.indexOf("?") != -1)
                      var char = "&";

                $(this).attr("src",url+char+"wmode=transparent");
        });
    });
</script>
</body>
</html>