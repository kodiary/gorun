<?php

/**
 * This is the model class for table "tbl_events".
 *
 * The followings are the available columns in table 'tbl_events':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $start_date
 * @property string $end_date
 * @property string $logo
 * @property string $file
 * @property varchar $venue
 * @property string $organizer
 * @property integer $visible
 * @property string $editor_type
 */
class Events extends CActiveRecord
{
    public $basic_editor;
    public $year;
    public $month;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Events the static model class
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
		return 'tbl_events';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_by, title, description, start_date, website, venue, latitude, longitude, organizer, organizer_contact, organizer_email, organizer_website', 'required'),
			array('visible', 'numerical', 'integerOnly'=>true),
			array('title, logo, file', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created_by, title, description, start_date, end_date, website, logo, file, venue, latitude, longitude, organizer, organizer_contact, organizer_email, organizer_website, readcount, visible', 'safe', 'on'=>'search'),
            
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'event_link'=>array(self::HAS_ONE,'EventsLink','event_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'created_by' => 'Created By',
			'title' => 'Event Title',
			'description' => 'Description',
			'start_date' => 'Event Date',
			'end_date' => 'End Date',
            'website' => 'Online Entry Link',
			'logo' => 'Logo',
			'file' => 'File',
			'venue' => 'Event Location',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
			'organizer' => 'organizer',
            'organizer_contact' => 'organizer_contact',
            'organizer_email' => 'organizer_email',
            'organizer_website' => 'organizer_website',
			'visible' => 'Visible',
            
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
        $criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('file',$this->file,true);
        $criteria->compare('website',$this->website);
		$criteria->compare('venue',$this->venue);
        $criteria->compare('latitide',$this->latitide);
        $criteria->compare('longitude',$this->longitude);
		$criteria->compare('organizer',$this->organizer);
        $criteria->compare('organizer_contact',$this->organizer_contact);
        $criteria->compare('organizer_email',$this->organizer_email);
        $criteria->compare('organizer_website',$this->organizer_website);
		$criteria->compare('visible',$this->visible);
        

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getEventsNotInNewsletter($newsletter_id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition="visible=1 AND start_date>=CURDATE()";
        $criteria->addNotInCondition('id',NewsletterItems::getItemsByType($newsletter_id,2));
        $criteria->order='start_date DESC';
        //$criteria->limit=20;
        return Events::model()->findAll($criteria);
    }
     
    public function eventInfo($event_id, $select='*')
    {
        $criteria = new CDbCriteria;
        $criteria->select=$select;
        $criteria->condition='id='.$event_id;
        return Events::model()->find($criteria);
    }
    
    public function Image($filename, $size='thumb', $alt='')
    {
        $baseUrl = Yii::app()->baseUrl;
        $basePath = Yii::app()->basePath;

        if($size=='thumb1'){
            $size = 'thumb';
            $html_opt = array('width'=>60, 'height'=>60);
        }
        else
            $html_opt = array();
            
        if(file_exists($basePath.'/../images/frontend/'.$size.'/'.$filename) && $filename)
            return CHtml::image($baseUrl.'/images/frontend/'.$size.'/'.$filename, $alt, $html_opt);
        else
            return CHtml::image($baseUrl.'/images/events_fallback_thumb.png', $alt, $html_opt);    
    }
    
    public function get_org_details($event_id,$organizer_id)
    {
        $org_detail = new stdClass();
        if($organizer_id==0)
        {
            if($details=organizers::model()->findByAttributes(array('event_id'=>$event_id)))
            {
              $org_detail->contact = $details->contact_number;
              //echo $details->contact_number;die();              
              $org_detail->website = $details ->website;  
              $org_detail->email = $details ->contact_email;         
            }            
            //return $details->contact_number;
        }
        else
        {   if($company=Company::model()->findByPk($organizer_id))
            {
              $org_detail->contact = $company->number;               
              $org_detail->website = $company->website;
              $org_detail->email = $details ->email;                   
            }        
            //$company=Company::model()->findByPk($organizer_id);
            
        }
        return $org_detail;
    }
    
    public function get_venue_details($event_id,$venue_id)
    {
        if($venue_id=="0")
        {
            $details=Venues::model()->findByAttributes(array('event_id'=>$event_id));
            return $details;
        }
        else
        {
            $details = array();
            $company=Company::model()->findByPk($venue_id);
            if($company)
            {
                $details['longitude'] = $company->longitude;
                $details['latitude'] = $company->latitude;
                $details['title'] = $company->name;
                $details['address'] = $company->display_address;
                $details['city'] = $company->street_add;
                $details['region'] = $company->province;
            }
            $object = new stdClass();
            foreach ($details as $key => $value)
            {
                $object->$key = $value;
            }
            return $object;
        }
    }
    
    public function prev_event_by_slug($event_id)
    {
        //$newsId = Articles::get_news_id_by_slug($slug);
        $criteria = new CDbCriteria;
        $criteria->select = array('slug', 'title');
        $criteria->addCondition('visible=1 AND end_date>=CURDATE() AND id<'.$event_id);
        $criteria->order = 'id DESC';
        $criteria->limit = 1;
        $event = Events::model()->find($criteria);
        if($event)
            return $event;
        else
            return false;    
    }
    
    //return next news
    public function next_event_by_slug($event_id)
    {
        $criteria = new CDbCriteria;
        $criteria->select = array('slug', 'title');
        $criteria->addCondition('visible=1 AND end_date>=CURDATE() AND id>'.$event_id);
        $criteria->order = 'id ASC';
        $criteria->limit = 1;
        $event = Events::model()->find($criteria);
        if($event)
            return $event;
        else
            return false; 
    }

    public function getActiveEvents($limit=3)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'start_date>=CURDATE() AND visible=1';
        $criteria->order = 'start_date ASC, id DESC';
        $criteria->limit = $limit;
        return Events::model()->findAll($criteria);
    }
      
    public function get_existing_month_year()
    {
        $criteria= new CDbCriteria;
        $criteria->distinct = true;
        $criteria->select = array('MonthName(start_date) as month','Year(start_date) as year');
        $criteria->addCondition('t.visible=1 AND t.start_date>CURDATE()');
        $criteria->order='start_date ASC';
        //$criteria->select = "SELECT distinct Month(start_date),Year(start_date) FROM `tbl_events` WHERE 1";
        
        $date = Events::model()->findAll($criteria);
        if($date)
            return $date;
        else
            return false;; 
    }
    
    public function getActiveUpcomingEvents($offset='')
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 't.visible=1 AND t.end_date>CURDATE()';
        $criteria->order = 't.start_date ASC';
        if($offset) $criteria->offset = $offset;
        $criteria->limit = Yii::app()->params['articles_pers_page'];
        
        $events = self::model()->findAll($criteria);
        return $events; 
    }
    
}