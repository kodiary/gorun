<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo 'Newsletter '.$model->number;?></title>

<style type="text/css">
body, h1, h2, h3, h4, h5, h6, p, ul, li,ol, a, img, div, span, label{margin:0; padding:0;}
img{border:0; vertical-align:middle;}
.clear{clear:both;}
a{line-height:0;}
p{line-height:20px}
</style>      

</head>
<body style="margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#666;">

<table width="700" align="center">

<?php if($model->template_id==1){ ?>
    <tr>
        <td colspan="3">
            <img src="<?php echo $this->createAbsoluteUrl('/images/exsa_express.jpg');?>" alt="EXSA Express" />
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <h1 style="font-size:20px;color:#000000; font-weight:normal; margin:15px 0 5px;"><?php echo $model->subject;?></h1>
        </td>
    </tr>
<?php }else{ ?>
    <tr style="background: #f6f6f6;">
        <td width="200">
            <img src="<?php echo $this->createAbsoluteUrl('/images/logo.png');?>" alt="Exsa" />
        </td>
        <td>
            <div style="width:10px; height:100px; display:block; background: #FFFFFF;"></div>
        </td>
        <td width="490" style="padding:30px 40px;">
            <span style="color:#0060A6;"><?php echo ($model->pub_date != '0000-00-00') ? date('l, d F Y', strtotime($model->pub_date)) : '' ?></span>
            <h1 style="font-size:18px;color:#000000; font-weight:normal; margin-top:15px;"><?php echo $model->subject;?></h1>
        </td>
    </tr>
<?php } ?>

<tr>
<td colspan="3">
<div  style="font-size: 14px; color: #333333; line-height: 18px;">
<?php if($model->detail!=""){ echo $model->detail; } ?>
</div>
</td>
</tr>


<?php
//articles
if(!empty($nitems['articles'])){
?>

<tr>
<td colspan="3">
<div style="margin-top:25px;height:8px; width:100%; display:block; background:#96BE29;"></div>
</td>
</tr>
<tr>
<td colspan="3">
        <ul style="margin:0;  padding:0;">
        <?php
        foreach($nitems['articles'] as $data)
        {
            $article=Articles::articleInfo($data->item_id);
            $filename=Articles::get1ImageFromFile($data->item_id);
             if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$filename) && $filename!="")
                $image = $this->createAbsoluteUrl('/images/frontend/thumb/'.$filename);
            else 
                $image = $this->createAbsoluteUrl('/images/article_fallback_80x80.png');
        ?>
        <li style="border-bottom:1px solid #ddd;padding:8px 0;list-style:none;margin:0">
            <a href="<?php echo $this->createAbsoluteUrl('/news/'.$article->slug)?>" style="padding:5px; float:left; border-radius:5px; border:1px solid #DDDDDD"><img src="<?php echo $image;?>" alt="<?php echo $article->title;?>"/></a>
            
            <div style="float:right; width: 595px;">
            <h1 style="font-size:19px;font-weight:normal;margin:0 0 5px ;"><a href="<?php echo $this->createAbsoluteUrl('/news/'.$article->slug)?>" style="text-decoration:none; color:#000000;"><?php echo $article->title; ?></a></h1>
            <p style="font-size: 13px; color:#666666; line-height: 16px; margin: 0;"><span style="color: #1A5EA6;"><?php echo CommonClass::formatDate($article->publish_date, 'd F, Y');?> - </span><?php echo CommonClass::limit_text($article->detail);?></p>
            </div>
            <div style="clear:both"></div>   
        </li>
        <?php
        }
        ?>
        </ul>
</td>
</tr>
<?php } ?>
    
<?php
//events
if(!empty($nitems['events'])){ 
?>
<tr>
<td colspan="3"><div style="height:8px; width:100%; display:block; background:#96BE29;"></div></td>
</tr>
<tr>
<td colspan="3">
        <ul style="margin:0; padding:0;">
        <?php
        foreach($nitems['events'] as $data)
        {
           $imagefile = Events::eventInfo($data->item_id,'logo');
           $event = Events::eventInfo($data->item_id);
           if(file_exists(Yii::app()->basePath.'/../images/frontend/main/'.$imagefile->logo) && $imagefile->logo!="")
            $image=$this->createAbsoluteUrl('/images/frontend/main/'.$imagefile->logo);
            else 
            $image=$this->createAbsoluteUrl('/images/events_fallback_main.png');
            ?>
            <li style="padding:8px 0;list-style:none; margin: 0;">
                <a href="<?php echo $this->createAbsoluteUrl('/events/'.$event->slug)?>" style="padding:5px; border:1px solid #ddd; float:left; border-radius:5px;"><img src="<?php echo $image;?>" alt="<?php echo $event->title;?>"/></a>
                
                <div style="float:right; width:550px;">
                <h1 style="font-size:23px; margin:0 0 5px; font-weight:normal;"><a href="<?php echo $this->createAbsoluteUrl('/events/'.$event->slug)?>" style="text-decoration:none; color:#000000;"><?php echo $event->title; ?></a></h1>
                <p style="margin:0 0 3px;"><span style="color:#CC2C2C; font-size:16px;">
                    <?php if($event->start_date!='0000-00-00' && $event->start_date<$event->end_date){
                        echo CommonClass::formatDate($event->start_date, 'd F')." - ".CommonClass::formatDate($event->end_date, 'd F, Y');
                    }else{
                        echo CommonClass::formatDate($event->start_date, 'd F Y');
                    }?>
                </span></p>
                <p><span style="color: #1A5EA6;font-size:16px;">
                    <?php
                        if($event->venue_id=="0")
                        {
                            $venue=Venues::model()->findByAttributes(array('event_id'=>$event->id));
                            $venue_location=$venue->title.", ".$venue->address;
                        }
                        else
                        {
                            $venue=Company::model()->findByPk($event->venue_id);
                            $venue_location=$venue->name;
                        }
                        echo $venue_location;
                    ?> 
                </span></p>
                </div>
                <div style="clear:both"></div>
            </li>
        <?php
        }
        ?>
         </ul>
</td>
</tr>
<?php } ?>
</table>
<div style="font-family: arial; width:700px; margin: 0 auto;">
<div style="height:8px; display:block; background:#96BE29; margin-bottom: 3px;"></div>
    <div style="text-align:center;color:#FFFFFF; font-size:18px;background:#000000;">
        <div style="padding:10px;color:#FFFFFF;">Exhibition &amp; Event Association of Southern Africa</div>
        <div style="clear:both"></div>
    </div>
    <div style="color:#000000; margin:20px 0; line-height: 22px;">
    <div style="text-align: center; margin-bottom:25px">
    <span style="font-size: 17px;"><strong>TEL +27 11 805 7272 | FAX +27 11 805 7272 | 
     Email <a href="mailto:exsa@exsa.co.za" style="text-decoration:none;color:#005FA5;">exsa@exsa.co.za</a></strong></span>
    <p style="font-size:15px; margin-top: 6px;">Ground Floor, Gallagher House, Gallagher Estate, Richards Drive <br/>
    Midrand, South Africa</p>
    </div>
    <div style="text-align: center;">
    <p style=" margin-bottom: 25px;"><a href="<?php echo $this->createAbsoluteUrl('/');?>" style="font-size:30px; line-height:38px; font-weight:bold; color:#1F5FAC; display:block; text-decoration:none;"><?php echo $this->createAbsoluteUrl('/');?></a></p> 
    <a href="<?php echo $this->createAbsoluteUrl('/subscribers/manage');?>" style="font-size:14px;font-weight:bold; color:#005FA5; text-decoration:none;">Click Here to Unsubscribe</a>
    </div></div>
</div>
</body>
</html>