<?php

/**
 * This is the model class for table "tbl_organisers".
 *
 * The followings are the available columns in table 'tbl_organisers':
 * @property integer $id
 * @property string $title
 * @property string $contact_number
 * @property string $contact_email
 * @property string $website
 * @property integer $event_id
 */
class Organisers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Organisers the static model class
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
		return 'tbl_organisers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, contact_number, contact_email, event_id', 'required','on'=>'organiser'),
			array('event_id', 'numerical', 'integerOnly'=>true),
			array('title, contact_number, contact_email, website', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, contact_number, contact_email, website, event_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Organiser',
			'contact_number' => 'Contact Number',
			'contact_email' => 'Contact Email',
			'website' => 'Website',
			'event_id' => 'Event',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('contact_number',$this->contact_number,true);
		$criteria->compare('contact_email',$this->contact_email,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('event_id',$this->event_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function check_org_in_db($id)
     {
        $check=Organisers::model()->findAllByAttributes(array('event_id'=>$id));
        if($check)
            return true;
        else
            return false;
     }
}