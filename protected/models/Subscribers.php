<?php

/**
 * This is the model class for table "tbl_subscribers".
 *
 * The followings are the available columns in table 'tbl_subscribers':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $password_real
 * @property string $title
 * @property string $first_name
 * @property string $last_name
 * @property string $company_name
 * @property string $position
 * @property string $contact_number
 * @property integer $display_identity
 * @property string $desc
 * @property string $logo
 * @property string $website
 * @property integer $subscribe_news
 * @property integer $subscribe_pulications
 * @property integer $subscribe_newsletters
 * @property integer $subscribe_podcasts
 * @property date $date_added
 * @property date $date_updated
 * @property integer $can_comment
 * @property bigint $social_user_id
 */
class Subscribers extends CActiveRecord
{
    public $verifyCode;
    public $repeat_password;
    public $step;
    public $member_id;
    public $url;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Subscribers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_subscribers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, email', 'required'),
			array('email', 'length', 'max'=>100),
			array('first_name, last_name', 'length', 'max'=>255),
            array('email','required','on'=>'subscribe,unsubscribe','message'=>'<div class="blue">Email Address cannot be blank.</div>'),
		    array('email', 'email','on'=>'subscribe,unsubscribe','message'=>'<div class="blue">Bad Email Address - <b>Try Again</b></div>'),
            array('email', 'unique','on'=>'subscribe','message'=>'<div class="blue">Email address already exists. - <b>Try Again</b></div>'),
            array('email', 'authenticate','on'=>'unsubscribe'),
            array('id, date_added, subscribe_newsletters, url', 'safe'),
		);
	}

    public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$subscriber=self::model()->exists('email="'.$this->email.'"');
            if(!$subscriber)$this->addError('email','<div class="blue">Bad Email Address - Address does not exists on our database</div>');
		}
	}
    
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'first_name' => 'First Name',
			'last_name' => 'Surname',
			'subscribe_newsletters' => 'EXSA Newsletters',
			'date_added' => 'Date Added',
            'verifyCode'=>'Verification Code',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('subscribe_newsletters',$this->subscribe_newsletters);
		$criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('url',$this->url);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    Public function getAllstates($list_id)
    {
       	$criteria=new CDbCriteria;
        $criteria->alias = 'sub';
        $criteria->select=array('*');
        $criteria->join='INNER JOIN tbl_subscribers_detail as list ON list.subscriber_id = sub.id';
        $criteria->condition = "list.list_id=".$list_id;
        
        return Subscribers::model()->findAll($criteria);
     
    }
    
    public function countSubscriber()
    {
        return Subscribers::model()->count();
    }
    
    public function getActiveSubscribers($nid)
    {
        $sql = "SELECT s.email FROM `tbl_subscribers` `s` 
                LEFT JOIN tbl_subscribers_detail ON tbl_subscribers_detail.subscriber_id = s.id 
                LEFT JOIN tbl_newsletter_list ON tbl_newsletter_list.list_id = tbl_subscribers_detail.list_id
                WHERE tbl_newsletter_list.newsletter_id=$nid AND s.subscribe_newsletters=1 
                UNION
                SELECT c.email FROM `tbl_company` `c` 
                LEFT JOIN tbl_subscribers_detail ON tbl_subscribers_detail.company_id = c.id
                LEFT JOIN tbl_newsletter_list ON tbl_newsletter_list.list_id = tbl_subscribers_detail.list_id 
                WHERE tbl_newsletter_list.newsletter_id=$nid AND c.status=1 
                ";
        return self::model()->findAllBySql($sql);
    }
    
    public function getActiveSubscribersCount($nid)
    {
        $sql = "SELECT s.email FROM `tbl_subscribers` `s` 
                LEFT JOIN tbl_subscribers_detail ON tbl_subscribers_detail.subscriber_id = s.id 
                LEFT JOIN tbl_newsletter_list ON tbl_newsletter_list.list_id = tbl_subscribers_detail.list_id 
                WHERE tbl_newsletter_list.newsletter_id=$nid AND s.subscribe_newsletters=1 
                UNION
                SELECT c.email FROM `tbl_company` `c` 
                LEFT JOIN tbl_subscribers_detail ON tbl_subscribers_detail.company_id = c.id
                LEFT JOIN tbl_newsletter_list ON tbl_newsletter_list.list_id = tbl_subscribers_detail.list_id 
                WHERE tbl_newsletter_list.newsletter_id=$nid AND c.status=1
                ";
        return count(self::model()->findAllBySql($sql));
    }
    
    public function existsSubscriber($email)
    {
        return Subscribers::model()->find('email="'.$email.'"');
    }
    
    public function getIdBySocialId($sc_id)
    {
        return self::model()->find('social_user_id='.$sc_id);
    }
}