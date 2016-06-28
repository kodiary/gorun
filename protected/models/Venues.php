<?php

/**
 * This is the model class for table "tbl_venues".
 *
 * The followings are the available columns in table 'tbl_venues':
 * @property integer $id
 * @property string $title
 * @property string $address
 * @property string $city
 * @property integer $region
 * @property double $latitude
 * @property double $longitude
 */
class Venues extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Venues the static model class
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
		return 'tbl_venues';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, address, city, region, latitude, longitude, country', 'required'),
			array('region', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude', 'numerical'),
			array('title, address, city', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, address, city, region, latitude, longitude', 'safe', 'on'=>'search'),
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
			'title' => 'Venue Name',
			'address' => 'Street Address',
			'city' => 'Suburb or Town',
			'region' => 'Province',
			'country'=> 'Country',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
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
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('region',$this->region);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
     public function check_venue_in_db($id)
     {
        $check=Venues::model()->findAllByAttributes(array('event_id'=>$id));
        if($check)
            return true;
        else
            return false;
     }
     
    public function getEventVenue($event_id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition='event_id='.$event_id;
        return Venues::model()->find($criteria);
    }
}