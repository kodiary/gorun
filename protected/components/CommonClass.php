<?php
class CommonClass extends CComponent
{
    public static function getSlug($string)
    {
        $new_string = preg_replace("/[^a-zA-Z0-9-\@\$ \s]/", "", strtolower(strip_tags($string)));
    	$rep_string = str_replace(" ","-",trim($new_string));
    	$rep_string = preg_replace('/-+/', '-', $rep_string);
    	$ret_string = preg_replace('/\'/','',$rep_string);
        return $ret_string;
    } 
    
    public static function format_file_size( $size)
    {
    	if( $size < 1024 )
    		$filesize = $size . ' bytes';
    	elseif( $size >= 1024 && $size < 1048576 )
    		$filesize = round( $size/1024, 1 ) . ' KB';
    
    	elseif( $size >= 1048576 )
    		$filesize = round( $size/1048576, 1 ) . ' MB';
    
    	return $filesize;
    }
    
    public static function get_resize_details($case)
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
             case "member":
                return array(
                    0=>array(
                        "width"=>"215",
                        "height"=>"215",
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
                        "width"=>"",
                        "height"=>"",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/full/',
                        "crop"=>"false",
                    )
                );
            break;
             case "member_cover":
                return array(
                    0=>array(
                        "width"=>"760",
                        "height"=>"200",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/thumb/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                     2=>array(
                        "width"=>"",
                        "height"=>"",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/full/',
                        "crop"=>"false",
                    )
                );
            break;
             case "club":
                return array(
                    0=>array(
                        "width"=>"220",
                        "height"=>"180",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/thumb/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                     1=>array(
                        "width"=>"460",
                        "height"=>"385",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/main/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                     2=>array(
                        "width"=>"",
                        "height"=>"",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/full/',
                        "crop"=>"false",
                    )
                );
            break;
             case "event":
                return array(
                    0=>array(
                        "width"=>"380",
                        "height"=>"285",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/thumb/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                     1=>array(
                        "width"=>"380",
                        "height"=>"285",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/main/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                     2=>array(
                        "width"=>"",
                        "height"=>"",
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
            
            case "review":
                return array(
                    0=>array(
                        "width"=>"80",
                        "height"=>"60",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/thumb/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                     2=>array(
                        "width"=>"800",
                        "height"=>"600",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/full/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                    3=>array(
                        "width"=>"240",
                        "height"=>"180",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/main/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
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
                        "width"=>"200",
                        "height"=>"85",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/thumb/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                    1=>array(
                        "width"=>"800",
                        "height"=>"340",
                        "new_path"=>Yii::app()->basePath.'/../images/temp/main/',
                        "crop"=>"true",
                        "crop_type"=>"center",
                    ),
                    2=>array(
                        "width"=>"",
                        "height"=>"",
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
    
    public static function get_precrop_size($width, $height, $resize_width, $resize_height){
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
    
    public static function get_center_crop_coordinates($width,$height,$rwidth, $rheight){
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
    
   public static function get_resized_width_height($width, $height,$resize_item)
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
    public static function limit_text($text, $limit='200')
    {
        $text=strip_tags($text);
        if (strlen($text) > $limit) {
          $text=substr($text,0,$limit) . '...';
        }
        return $text;
    }

    public static function getCleanData($string,$limit=0)
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
	public static function sendEmail($fromName="", $fromEmail="", $receiverEmail, $subject, $body,$replyTo="") 
	{
		if($fromName!="" && $fromEmail!="")
			$from = $fromName."<".$fromEmail.">";
		else
			$from = 'gorun.co.za<info@gorun.co.za>';//email sent from the site
        
        $email = Yii::app()->email;
        $email->from = $from;
        $email->to = $receiverEmail;
        $email->replyTo = ($replyTo!="")?$replyTo:"Gorun.co.za <noreply@gorun.co.za>";
        //if($replyTo!="")$email->replyTo = $replyTo;
        $email->subject = $subject;
        //$email->message = $body;
        $email->view= 'passwordReminder';
        $email->viewVars=array('email_add'=>$email_add,'password'=>$password,'name'=>$name);
        if($email->send())
            return true;
        else
            return false;		
	}
	
	public static function sendNewsletter($fromName="", $fromEmail="", $receiverEmail, $subject, $body,$replyTo="") 
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
	            ->setFrom(($fromName!="" && $fromEmail!="")?array($fromEmail,$fromName):array('info@gorun.co.za' => 'gorun.co.za'))
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
    
    public static function makeSlug( $model, $title, $id)
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
    public static function formatDate($date, $format='d F Y')
    {
        if($date!='0000-00-00'){
            $date = date_create($date);
            return date_format($date, $format);
        }
    }
    
    public static function formatDatetime($date, $format='d F Y')
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
    
    public static function getIP()
    {
        if (getenv(HTTP_X_FORWARDED_FOR)) {
            $ipaddress = getenv(HTTP_X_FORWARDED_FOR);
        } else {
            $ipaddress = getenv(REMOTE_ADDR);
        }
        return $ipaddress;
    } 
    public static function Dot2LongIP ($IPaddr)
    {
        if ($IPaddr == "") {
            return 0;
        } else {
            $ips = split ("\.", "$IPaddr");
            return ($ips[3] + $ips[2] * 256 + $ips[1] * 256 * 256 + $ips[0] * 256 * 256 * 256);
        }
    }
    
    public static function getSeoByPage($page)
    {
        $model=Seo::model()->findByAttributes(array('PageSlug'=>$page));
        $seo['title']=$model->SeoTitle;
        $seo['desc']=$model->SeoDesc;
        $seo['keys']=$model->SeoKeywords;
        return $seo;
    }
    
    
    public static function getYoutubeCodeFromUrl($url)
    {
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$url,$matches);
        // $matches[ 1 ] should contain the youtube id
        return $matches[1];
    }
    
    
    // autopost
    public static function autoPost($section,$id)
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
    
    public static function facebookPost($info)
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

    public static function autoFacebookPost($info)
    {
        // Attempt to query the graph:
        $title = $info['title'];
        $description = $info['description'];
        $image = $info['image'];
        $link = $info['link'];
        
        $page_id = Yii::app()->params['page_id'];
        $user_access_token = Yii::app()->params['user_access_token'];
        $graph_url = "https://graph.facebook.com/me/accounts?access_token=".$user_access_token;
        $pages = json_decode(file_get_contents($graph_url), true);
        
        if($pages){
            foreach($pages['data'] as $p){
                if($p['id'] == $page_id){
                    $page_access_token = $p['access_token'];
                    break;
                }
            }
        }
        
        if($page_access_token){
            $params = array('access_token'=>$page_access_token,
                            'name' => $title,
                            'description' => $description,
                            'link' => $link,
                            'picture' => $image,
                            /*'link' => 'www.google.com',
                            'picture' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBZk5DwHBiA0y1Y0-2It7MOUll6vDYa50le8LdyzMcGIw4owdI'*/
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
                echo $decoded_response->error->message;
                echo "failed";exit;
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

    //This is the URL you want to shorten
    public static function shortUrl($long)
    {
        $longUrl = $long;
        $apiKey = 'AIzaSyDAjOX47PDM9vqQLULu4rkBR_kKKRlXm1k';
        //Get API key from : http://code.google.com/apis/console/
        
        $postData = array('longUrl' => $longUrl, 'key' => $apiKey);
        $jsonData = json_encode($postData);
        
        $curlObj = curl_init();
        
        curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlObj, CURLOPT_HEADER, 0);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($curlObj, CURLOPT_POST, 1);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
        
        $response = curl_exec($curlObj);
        
        //change the response json string to object
        $json = json_decode($response);
        
        curl_close($curlObj);
        
        return $json->id;
    }

    public static function autoTwitterPost($info) //array as an argument
    {
        $consumer_key = Yii::app()->params['twitter_consumer_key'];
        $consumer_secret = Yii::app()->params['twitter_consumer_secret'];
        $access_token = Yii::app()->params['twitter_access_token'];
        $access_secret = Yii::app()->params['twitter_access_token_secret'];
        
        $name = $info['title'];
        $description = $info['description'];
        $link = $info['link'];
        $url = CommonClass::shortUrl($link);

        Yii::import('ext.twitter.TwitterOAuth');
        $tweet = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_secret);        
        
        // Your Message
        //$message = $name.$description;
        $message = $name;
        $data = $tweet->post('/statuses/update', array('status' => "$message\n$url"),true,true);        
        if($data->errors[0]->code==''){
            return true;
        }
        else{
//print_r($data);die;
            return false;
        }
    }

    public static function getFollowersCount() {
        Yii::import('ext.twitter.TwitterAPIExchange');
        /** Set access tokens here - see: https://dev.twitter.com/apps/ * */
        $settings = array(
            'oauth_access_token' => Yii::app()->params['twitter_access_token'],
            'oauth_access_token_secret' => Yii::app()->params['twitter_access_token_secret'],
            'consumer_key' => Yii::app()->params['twitter_consumer_key'],
            'consumer_secret' => Yii::app()->params['twitter_consumer_secret']
        );

        /** Perform a GET request and echo the response * */
        /** Note: Set the GET field BEFORE calling buildOauth(); * */
        $url = 'https://api.twitter.com/1.1/users/lookup.json';
        $getfield = '?screen_name=' . Yii::app()->params['twitter_user'];
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings);
        $t_user = $twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest();
        if ($t_user) {
            $t_user = json_decode($t_user, true);
            return (int)  $t_user[0]['followers_count'];
        } else {
            return '0';
        }
    }

    public static function countFBLikes() {
        $fb_page_id = Yii::app()->params['page_id'];
        $data = @file_get_contents("https://graph.facebook.com/" . $fb_page_id);
        $data = json_decode($data);
        if (isset($data->likes))
            return $data->likes;
        else
            return '0';
    }
    //genertare random strings
    public static function randomString($length = 6) {
	$str = "";
	$characters = array_merge(range('A','Z'),range('0','9'),range('a','z') );
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
    }
    
    public static function encoded_password($string)
    {
        $s = substr($string,strlen($string)-3,3);
        return "****".$s;
    }
   public static function sendConfirmationEmail($member){
        $pin = CommonClass::randomString('8');
        Yii::app()->session["pin_$member->id"] = $pin;
        $url =  Yii::app()->createAbsoluteUrl("member/confirmation/hash/".sha1($member->email)."acef".$member->id);
        
        $email = Yii::app()->email;
        $email->to =  $member->email;
        $email->from = "Gorun.co.za <info@gorun.co.za>";
        $email->replyTo="Gorun.co.za <noreply@gorun.co.za>";
        $email->subject = 'Confirmation Email';
        $email->view= 'signup';
        $email->viewVars=array('fname'=>ucfirst($member->fname),'lname'=>ucfirst($member->lname),'pin'=>$pin,'url'=>$url);
        if($email->send())
            return $pin;
        else
            return false;
        
        /*$msg = Yii::app()->controller->renderPartial('application.views.email.signup', array('fname'=>ucfirst($member->fname),'lname'=>ucfirst($member->lname),'pin'=>$pin,'url'=>$url), true);
        if(CommonClass::sendEmail("GO RUN","noreply@gorun.co.za",$member->email,"Confirmation Email",$msg))
            return $pin;*/
        
    }
}
?>