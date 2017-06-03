<?php

/**
 * This is the model class for table "tbl_ip_location".
 *
 * The followings are the available columns in table 'tbl_ip_location':
 * @property double $ip_id
 * @property double $ip_to
 * @property string $ip_from
 * @property string $ip_country_code
 * @property string $ip_country_name
 * @property string $ip_region
 * @property string $ip_city
 * @property double $ip_lalitude
 * @property double $ip_longitude
 * @property string $ip_zip_code
 * @property string $ip_time_zone
 */
class IpLocation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IpLocation the static model class
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
		return 'tbl_ip_location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip_id, ip_to, ip_lalitude, ip_longitude', 'numerical'),
			array('ip_from', 'length', 'max'=>11),
			array('ip_country_code', 'length', 'max'=>6),
			array('ip_country_name', 'length', 'max'=>192),
			array('ip_region, ip_city', 'length', 'max'=>384),
			array('ip_zip_code', 'length', 'max'=>30),
			array('ip_time_zone', 'length', 'max'=>21),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ip_id, ip_to, ip_from, ip_country_code, ip_country_name, ip_region, ip_city, ip_lalitude, ip_longitude, ip_zip_code, ip_time_zone', 'safe', 'on'=>'search'),
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
			'ip_id' => 'Ip',
			'ip_to' => 'Ip To',
			'ip_from' => 'Ip From',
			'ip_country_code' => 'Ip Country Code',
			'ip_country_name' => 'Ip Country Name',
			'ip_region' => 'Ip Region',
			'ip_city' => 'Ip City',
			'ip_lalitude' => 'Ip Lalitude',
			'ip_longitude' => 'Ip Longitude',
			'ip_zip_code' => 'Ip Zip Code',
			'ip_time_zone' => 'Ip Time Zone',
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

		$criteria->compare('ip_id',$this->ip_id);
		$criteria->compare('ip_to',$this->ip_to);
		$criteria->compare('ip_from',$this->ip_from,true);
		$criteria->compare('ip_country_code',$this->ip_country_code,true);
		$criteria->compare('ip_country_name',$this->ip_country_name,true);
		$criteria->compare('ip_region',$this->ip_region,true);
		$criteria->compare('ip_city',$this->ip_city,true);
		$criteria->compare('ip_lalitude',$this->ip_lalitude);
		$criteria->compare('ip_longitude',$this->ip_longitude);
		$criteria->compare('ip_zip_code',$this->ip_zip_code,true);
		$criteria->compare('ip_time_zone',$this->ip_time_zone,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}