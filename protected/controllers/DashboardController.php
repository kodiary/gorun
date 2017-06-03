<?php
class DashboardController extends Controller
{
    public $layout='//layouts/column2';
    
    public function init() 
    {
       
        if(Yii::app()->user->isGuest)
        {
            
            $this->redirect(Yii::app()->request->baseUrl);
        }
        else
        {
            $member = Member::model()->findByPk(Yii::app()->user->id);
            
            if($member->is_verified=='0')
            {
                //Yii::app()->user->logout();
                Yii::app()->session->open();
                Yii::app()->user->setFlash('error', '<strong>Error - </strong> Please verify your email and try to login.');
                $this->redirect(Yii::app()->request->baseUrl);
            }
        }
    }
    public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
    public function actionIndex()
	{
	    Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.js"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));
         
        $member = Member::model()->findByPk(Yii::app()->user->id)->with('club');
        //var_dump($member);
        if(isset($_POST['first_login']))
        {
            $member->saveAttributes(['is_verified'=>'2']);
        }
        if(isset($_POST['submit']))
        {
            
            $member->fname = $_POST['fname'];
            $member->lname = $_POST['lname'];
            $member->email = $_POST['email'];
            $member->dob = $_POST['y_ob']."-".$_POST['m_ob']."-".$_POST['d_ob'];
            $member->username = $_POST['username'];
            $member->mobile = $_POST['mobile'];
            $member->sa_identity_no = $_POST['sa_identity_no'];
            $member->facebook = $_POST['facebook'];
            $member->twitter = $_POST['twitter'];
            $member->google = $_POST['google'];
            $member->detail = $_POST['detail'];
            $member->gender = $_POST['gender'];
            $member->suburb = $_POST['suburb'];
            $member->province = $_POST['province'];
            
            if($_POST['logo']!='')
            {
                $logo = explode("?rand",$_POST['logo']);
                $_POST['logo'] = $logo[0];
                @copy(Yii::app()->basePath.'/../images/temp/full/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/full/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/main/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/main/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/thumb/'.$_POST['logo']);
                
                @unlink(Yii::app()->basePath."/../images/temp/full/".$_POST['logo']);
                @unlink(Yii::app()->basePath."/../images/temp/main/".$_POST['logo']);
                @unlink(Yii::app()->basePath."/../images/temp/thumb/".$_POST['logo']);
                $member->logo = $_POST['logo'];                
            }
            if($_POST['cover']!='')
            {
                $logo = explode("?rand",$_POST['cover']);
                $_POST['cover'] = $logo[0];
                @copy(Yii::app()->basePath.'/../images/temp/full/'.$_POST['cover'],Yii::app()->basePath.'/../images/frontend/full/'.$_POST['cover']);
                @copy(Yii::app()->basePath.'/../images/temp/main/'.$_POST['cover'],Yii::app()->basePath.'/../images/frontend/main/'.$_POST['cover']);
                @copy(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['cover'],Yii::app()->basePath.'/../images/frontend/thumb/'.$_POST['cover']);
                
                @unlink(Yii::app()->basePath."/../images/temp/full/".$_POST['cover']);
                @unlink(Yii::app()->basePath."/../images/temp/main/".$_POST['cover']);
                @unlink(Yii::app()->basePath."/../images/temp/thumb/".$_POST['cover']);
                $member->cover = $_POST['cover'];                
            }
            //var_dump($member);
            if($member->save())
            {
                $id = $member->id;
                MemberExtra::model()->deleteAllByAttributes(['member_id'=>$id]);
                foreach($_POST['championchip'] as $number)
                {
                    if($number != '')
                    {
                        $memberExtra = new MemberExtra;
                        $memberExtra->type = 'championchip';
                        $memberExtra->value= $number;
                        $memberExtra->member_id = $id;
                        $memberExtra->save();
                        unset($memberExtra);
                    }
                }
                
                foreach($_POST['tracetec'] as $number)
                {
                    if($number != "")
                    {
                        $memberExtra = new MemberExtra;
                        $memberExtra->type = 'tracetec';
                        $memberExtra->value= $number;
                        $memberExtra->member_id = $id;
                        $memberExtra->save();
                        unset($memberExtra);
                    }
                }
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your details has been updated successfully!');
            }
            
          
              
        }
        if($member->is_verified == '1')
            $this->render('first_login',['not_verified'=>'1']);
        else
            $this->render('index',['member'=>$member,'not_verified'=>$member->is_verified]);
        
	}
    
    public function actionClub()
    {
        $clubs = ClubMember::model()->findAllByAttributes(['member_id'=>Yii::app()->user->id]);
        $this->render('clubs',['clubs'=>$clubs]);
    }
    
    public function actionPassword()
    {
        
        $member = Member::model()->findByPk(Yii::app()->user->id);
        $pass = CommonClass::encoded_password($member->password_real);
        if(isset($_POST['submit']))
        {
            $member->password_real = $_POST['password'];
            $member->password = sha1($_POST['password']);
            if($member->save())
            {
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your password has been updated successfully!');
            }
        }
        $this->render('password',['password'=>$pass]);

    }
    /**
 * public function actionDetails($slug)
 *     {
 *         
 *         Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/jquery.infinitescroll.js"));
 *         //$club = Club::model()->with(['extras','member:recent'=>['together'=>true]])->findByAttributes(['slug'=>$slug],['limit'=>2]);
 *         $member = Member::model()->findByAttributes(['username'=>$slug]);
 *        
 *         $events = EventsType::model()->findAll();
 *         
 *         $companyId = Yii::app()->user->id;
 *         $criteria = new CDbCriteria;
 *         $criteria->condition = 'company_id='.$member->id;
 *         $criteria->order = 'publish_date DESC,t.id DESC';
 *         $isfollowed = MemberFollow::model()->isfollowed($member->id,Yii::app()->user->id);
 *         //$results_best = EventResult::model()->findAllByAttributes(['user_id'=>Yii::app()->user->id, ]);
 *                
 *         $results = Yii::app()->db->createCommand('SELECT distance,dist_time,event_type FROM tbl_event_result AS a, (SELECT MIN(dist_time) AS mini FROM tbl_event_result GROUP BY event_type ,distance ) AS m WHERE m.mini = a.dist_time AND a.user_id='.$member->id.' ORDER BY a.event_type ASC, distance ASC')->queryAll();
 *         //$clubs = ClubMember::model()->findAllByAttributes(['member_id'=>$member->id]);
 *         $clubs = Yii::app()->db->createCommand()
 *             ->select('title')
 *             ->from('tbl_clubs c')
 *             ->join('tbl_club_members m', 'c.id=m.club_id AND m.member_id=:mid',array(':mid'=>$member->id))
 *             ->order('c.title asc')
 *             ->queryAll();
 *         $pages='';
 *         $this->render('details', array('model'=>$member,'pages'=>$pages,'isfollowed'=>$isfollowed,'events'=>$events,'results'=>$results,'clubs'=>$clubs));
 *         
 *        
 *     }
 */
    function actionUnfollow()
    {
        if(Yii::app()->user->isGuest)
        {
            $this->redirect(Yii::app()->request->baseUrl);
        }
        if(isset($_POST['follower_id']))
        {
            if(MemberFollow::model()->deleteAllByAttributes(['follower_id'=>$_POST['follower_id'],'member_id'=>Yii::app()->user->id]))
            {    Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Athelete Unfollowed!');
                echo "OK";
            }
            else
                echo "Error";
            
            die();
            
        }
    }
    function actionFollow()
    {
        if(Yii::app()->user->isGuest)
        {
            $this->redirect(Yii::app()->request->baseUrl);
        }
        if(isset($_POST['follower_id']))
        {
            $clubmember = new MemberFollow;
            $clubmember->follower_id = $_POST['follower_id'];
            $clubmember->member_id = Yii::app()->user->id;
            if($clubmember->save())
            {
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Athelete Followed!');
                echo "OK";
            }
            else
                echo "Error";
            
            die();
            
        }
    }
    
    

    
}