<?php
class CommonClass extends CComponent
{
    public function getSlug($string)
    {
        $new_string = preg_replace("/[^a-zA-Z0-9-\@\$ \s]/", "", strtolower(strip_tags($string)));
    	$rep_string = str_replace(" ","-",trim($new_string));
    	$rep_string = preg_replace('/-+/', '-', $rep_string);
    	$ret_string = preg_replace('/\'/','',$rep_string);
        return $ret_string;
    } 
    
    public function format_file_size( $size)
    {
    	if( $size < 1024 )
    		$filesize = $size . ' bytes';
    	elseif( $size >= 1024 && $size < 1048576 )
    		$filesize = round( $size/1024, 1 ) . ' KB';
    
    	elseif( $size >= 1048576 )
    		$filesize = round( $size/1048576, 1 ) . ' MB';
    
    	return $filesize;
    }
    
    public function get_resize_details($case)
    {
        switch($case){
            # articles
            case "articles":
                return array(
                    0=>array(
                        "width"=>"80",
                        "height"=>"80",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/thumb/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                    1=>array(
                        "width"=>"700",
                        "height"=>"600",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/full/',
                        "crop"=>"false",
                    )
                );
            break;
            
            case "association":
                return array(
                    0=>array(
                        "width"=>"56",
                        "height"=>"50",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/thumb/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                    1=>array(
                        "width"=>"200",
                        "height"=>"150",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/main/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                    2=>array(
                        "width"=>"400",
                        "height"=>"300",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/full/',
                        "crop"=>"false",
                    )
                );
            break;
            
            case "company_logo":
                return array(
                   0=>array(
                        "width"=>"120",
                        "height"=>"90",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/thumb/',
                        "crop"=>"false",
                    ),
                   1=>array(
                        "width"=>"260",
                        "height"=>"190",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/main/',
                        "crop"=>"false",
                    ),
                    2=>array(
                        "width"=>"600",
                        "height"=>"600",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/full/',
                        "crop"=>"false",
                    )
                );
            break;
            
            case "gallery":
                return array(
                    0=>array(
                        "width"=>"80",
                        "height"=>"80",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/thumb/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                     1=>array(
                        "width"=>"340",
                        "height"=>"240",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/main/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                     2=>array(
                        "width"=>"700",
                        "height"=>"600",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/full/',
                        "crop"=>"false",
                    )
                );
            break;
            
            case "background_banner":
                return array(
                    0=>array(
                        "width"=>"90",
                        "height"=>"90",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/main/',
                        "crop"=>"true",
                        "crop_type"=>"left",
                    ),
                   1=>array(
                        "width"=>"3000",
                        "height"=>"3000",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/full/',
                        "crop"=>"false",
                    )
                );
            break;      
            
            case "event_logo":
                return array(
                    0=>array(
                        "width"=>"90",
                        "height"=>"67",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/thumb/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                     1=>array(
                        "width"=>"120",
                        "height"=>"90",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/main/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                     2=>array(
                        "width"=>"500",
                        "height"=>"380",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/original/',
                        "crop"=>"false",
                    ),
                     3=>array(
                        "width"=>"250",
                        "height"=>"190",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/full/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    )
                );
            break;
             case "slideshow":
                return array(
                    0=>array(
                        "width"=>"255",
                        "height"=>"70",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/thumb/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                    1=>array(
                        "width"=>"980",
                        "height"=>"270",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/main/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                    2=>array(
                        "width"=>"1120",
                        "height"=>"330",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/full/',
                        "crop"=>"false",
                    )
                );
            break;   
             case "patronslider":
                return array(
                    0=>array(
                        "width"=>"124",
                        "height"=>"84",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/thumb/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                    1=>array(
                        "width"=>"360",
                        "height"=>"260",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/main/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                    2=>array(
                        "width"=>"360",
                        "height"=>"260",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/full/',
                        "crop"=>"false",
                    )
                );
            break;          
        }
    }
    
    public function get_precrop_size($width, $height, $resize_width, $resize_height){
        if($width<$height){
            $new_width = $resize_width;
            $new_height = ($new_width/$width)*$height;
            if($new_height > $height){
                $new_height = $height;
                $new_width = ($new_height/$height)*$width;
            }            
        }
        else if($width == $height){
            if($resize_width>$resize_height){
                $new_width = $resize_width;
                $new_height = ($new_width/$width)*$height;
            }
            else{
                $new_height = $resize_height;
                $new_width = ($new_height/$height)*$width;
            }
        }
        else{
            $new_height = $resize_height;
            $new_width = ($new_height/$height)*$width;
            if($new_width < $resize_width){
                $new_height  = ($resize_width/$new_width)*$new_height;
                $new_width = $resize_width;
            }
        }
        return array($new_width, $new_height);
    }
    
    public function get_center_crop_coordinates($width,$height,$rwidth, $rheight){
        if($width>$height){
            $x = ($width/2) - ($rwidth/2);
            $y = 0;
        }
        else{
            $y = ($height/2) - ($rheight/2);
            $x = 0;
        }
        return array("x"=>$x,"y"=>$y);
    }
    
   public function get_resized_width_height($width, $height,$resize_item)
   {
        if(is_array($resize_item))
        {
            if(($resize_item["crop"]=="true"))
            {
                list($resize_width, $resize_height) = self::get_precrop_size($width,$height,$resize_item["width"],$resize_item["height"]);
            }
            else
            {
                if($width > $resize_item["width"] || $height > $resize_item["height"])
                {
                    if($width>$height)
                    {
                        $resize_width = $resize_item["width"];
                        $resize_height = (($resize_item["width"]/$width)*$height);
                    }
                    else
                    {
                        $resize_height = $resize_item["height"];
                        $resize_width = (($resize_item["height"]/$height)*$width);
                    }
                }
                else
                {
                    $resize_width = $width;
                    $resize_height = $height;
                }
            }
            return array($resize_width, $resize_height); 
        }
    }
    /**
    *limit the text
    * string text
    * int limit
    * return truncated text
    */  
    public function limit_text($text, $limit='200')
    {
        $text=strip_tags($text);
        if (strlen($text) > $limit) {
          $text=substr($text,0,$limit) . '...';
        }
        return $text;
    }

    public function getCleanData($string,$limit=0)
    {
        if($limit!=0 && strlen(strip_tags($string))>$limit){
                $return_string = substr(trim(strip_tags($string)),0,$limit);
        }else
                $return_string = trim(strip_tags($string));
        return $return_string;
    }
       
   /**
	* Email function
	* @param string $fromName	
	* @param string $fromEmail	
	* @param string $receiverEmail	
	* @param string $subject	
	* @param string $body	
	* @return 1 or null
	*/
	public function sendEmail($fromName="", $fromEmail="", $receiverEmail, $subject, $body,$replyTo="") 
	{
		if($fromName!="" && $fromEmail!="")
			$from = $fromName."<".$fromEmail.">";
		else
			$from = 'Exsa.co.za<info@exsa.co.za>';//email sent from the site
        
        $email = Yii::app()->email;
        $email->from = $from;
        $email->to = $receiverEmail;
        if($replyTo!="")$email->replyTo = $replyTo;
        $email->subject = $subject;
        $email->message = $body;
        if($email->send()) return true;
        else return false;		
	}
	
	public function sendNewsletter($fromName="", $fromEmail="", $receiverEmail, $subject, $body,$replyTo="") 
	{
		// Get mailer
	        $SM = Yii::app()->swiftMailer;
	     
	        // Get config
	        $mailHost = 'localhost';
	        $mailPort = 465; // Optional
	 
	        // New transport
	        /*$SM->username='AKIAJTEYL2RROEDNRAMA';
	        $SM->password='AmAMDbVx3zHOrsZrdw18CfRX/oB/Dy8g4hiyZOH7SpZJ';*/
	        $Transport = $SM->mailTransport();
	     
	        // Mailer
	        $Mailer = $SM->mailer($Transport);
	        // New message
	        $Message = $SM
	            ->newMessage($subject)
	            ->setFrom(($fromName!="" && $fromEmail!="")?array($fromEmail,$fromName):array('info@exsa.co.za' => 'Exsa.co.za'))
	            ->setTo($receiverEmail)
	            ->addPart($body, 'text/html');
	     
	        // Send mail
	        $result = $Mailer->batchSend($Message);
	        //$result = $Mailer->send($Message);  
	        if($result)
	        {
	            return true;
	        }
	        else return false;
	}
    
    public function makeSlug( $model, $title, $id)
    {
        $slug = CommonClass::getSlug($title);
        $criteria = new CDbCriteria;
        $criteria->condition = "id <> '$id' AND slug = '$slug'";
        if($model->findAll($criteria)){
            $slug = $slug.$id;
        }
       
        $model->updateByPk($id, array('slug'=>$slug));
        return true;
    }
    
    /*
        * string date
        * string format
    */
    public function formatDate($date, $format='d F Y')
    {
        if($date!='0000-00-00'){
            $date = date_create($date);
            return date_format($date, $format);
        }
    }
    
    public function formatDatetime($date, $format='d F Y')
    {
        $dates = explode(' ',$date);
        
        if($dates[0]!='0000-00-00'){
            $date = date($format,strtotime($dates[0]));
            return $date." at ".$dates[1];
        }
        else
        {
            return "Not Defined";
        }
    }
    
    public function getIP()
    {
        if (getenv(HTTP_X_FORWARDED_FOR)) {
            $ipaddress = getenv(HTTP_X_FORWARDED_FOR);
        } else {
            $ipaddress = getenv(REMOTE_ADDR);
        }
        return $ipaddress;
    } 
    public function Dot2LongIP ($IPaddr)
    {
        if ($IPaddr == "") {
            return 0;
        } else {
            $ips = split ("\.", "$IPaddr");
            return ($ips[3] + $ips[2] * 256 + $ips[1] * 256 * 256 + $ips[0] * 256 * 256 * 256);
        }
    }
    
    public function getSeoByPage($page)
    {
        $model=Seo::model()->findByAttributes(array('PageSlug'=>$page));
        $seo['title']=$model->SeoTitle;
        $seo['desc']=$model->SeoDesc;
        $seo['keys']=$model->SeoKeywords;
        return $seo;
    }
    
    
    public function getYoutubeCodeFromUrl($url)
    {
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$url,$matches);
        // $matches[ 1 ] should contain the youtube id
        return $matches[1];
    }
    
    
    // autopost
    public function autoPost($section,$id)
    {
        if(isset($id) && $id!='')
        {
            if($section=='articles')
            {
                $imageModel = ArticleFile::model()->findAllByAttributes(array('article_id'=>$id,'file_type'=>'1'));
                $imageUrl = $this->createAbsoluteUrl('/images/article_fallback_80x80.png');
                if($imageModel)
                {
                    //$filename = $imageModel[count($imageModel)-1]->filename;  //latest image
                    $filename = $imageModel[0]->filename;
                    if(file_exists(Yii::app()->basePath.'/../images/frontend/full/'.$filename) && $filename)
                    {
                        $imageUrl = $this->createAbsoluteUrl('/images/frontend/full/'.$filename);
                    }
                    /*else
                    {
                        Yii::app()->user->setFlash('error', '<strong>Error!</strong> - Image File does not exist.');
                    }
                }
                else
                {
                    Yii::app()->user->setFlash('error', '<strong>Error!</strong> - You must upload atleast one image to auto-post this article in social media.');*/
                }
                
                $model = Articles::model()->articleInfo($id);
                if($model)
                {
                    //initilization
                    $info['title'] = $model->title;
                    $detail = strip_tags($model->detail);
                    $info['link'] = $this->createAbsoluteUrl('/news/'.$model->slug);
                    $info['description'] = CommonClass::limit_text($detail,'100');
                    $info['image'] = $imageUrl;

                    $success_msg = '';
                    $error_msg = '';
                    $fb_report = false;

                    $mediaModel = Articles::model()->articleInfo($id);
                    if($mediaModel->fb_post!=1)
                    {
                        //autopost for facebook
                        //if(CommonClass::autoFbPost($info)){
                        if(CommonClass::facebookPost($info)){
                            $model = new Articles;
                            $model->updateByPk($id, array('fb_post'=>1));
                            $success_msg = 'Your article has been successfully posted in your facebook page.';
                            $fb_report = true;
                        }
                        else{
                            $error_msg = 'Your article could not be posted to your facebook page.';
                            $fb_report = false;
                        }
                    }                            
                    
                    //conditional check
                    if($fb_report==true)
                        Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> '.$success_msg);
                    
                    else
                        Yii::app()->user->setFlash('error', '<strong>Error!</strong> '.$error_msg);
                }
            }    
        }
    }
    
    public function facebookPost($info)
    {
        // Attempt to query the graph:
        $title = $info['title'];
        $description = $info['description'];
        $image = $info['image'];
        $link = $info['link'];
        
        $page_id = Yii::app()->params['page_id'];
        $user_access_token = Yii::app()->params['user_access_token'];
        $page_access_token = $user_access_token;
        /*$graph_url = "https://graph.facebook.com/me/accounts?access_token=".$user_access_token;
        $pages = json_decode(file_get_contents($graph_url), true);
        
        if($pages){
            foreach($pages['data'] as $p){
                if($p['id'] == $page_id){
                    $page_access_token = $p['access_token'];
                    break;
                }
            }
        }*/
        
        if($page_access_token){
            $params = array('access_token'=>$page_access_token,
                            'name' => $title,
                            'description' => $description,
                            'link' => $link,
                            'picture' => $image,
                            //'link' => 'www.google.com',
                            //'picture' => 'http://www.kurzweilai.net/images/Google-logo1.jpg'
                      );
            $url = "https://graph.facebook.com/$page_id/feed";
            
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_POSTFIELDS => $params,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_VERBOSE => true
            ));
            $result = curl_exec($ch);
            $decoded_response = json_decode($result);
            
            //Check for errors 
            if ($decoded_response==null || $decoded_response->error) {
                //echo $decoded_response->error->message;
                //echo "failed";exit;
                return false;
            }
            else{
                //echo "success";exit;
                return true;
            }
        }
        else{
            //echo "pagetoken error";exit;
            return false;    
        }
    }
}
?>