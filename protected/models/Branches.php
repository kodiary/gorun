<?php

/**
 * This is the model class for table "tbl_branches".
 *
 * The followings are the available columns in table 'tbl_branches':
 * @property integer $id
 * @property integer $company_id
 * @property string $name
 * @property string $number
 * @property string $fax
 * @property string $email
 * @property string $manager
 * @property string $display_address
 * @property string $street_add
 * @property string $suburb
 * @property integer $province
 * @property integer $country
 * @property double $latitude
 * @property double $longitude
 * @property string $slug
 * @property date $date_updated
 */
class Branches extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Branches the static model class
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
		return 'tbl_branches';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, number, email,street_add, province,country,manager', 'required'),
            array('email','email'),
			array('province,country', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude', 'numerical'),
			array('id, company_id,fax, display_address, suburb, latitude, longitude, slug,date_updated', 'safe'),
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
            'company_id' => 'Company ID',
			'name' => 'Branch Name',
			'number' => 'Conatct Number',
			'fax' => 'Fax Number',
			'email' => 'Contact E-mail',
			'manager' => 'Branch Manager',
			'display_address' => 'Display Address',
            'street_add' => 'Street Address 1',
			'suburb' => 'Suburb',
			'province' => 'Province',
            'country' => 'Country',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'slug' => 'Slug',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('manager',$this->manager,true);
		$criteria->compare('display_address',$this->display_address,true);
		$criteria->compare('suburb',$this->suburb,true);
		$criteria->compare('province',$this->province);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('slug',$this->slug,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}