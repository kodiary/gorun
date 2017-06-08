<?php

/**
 * This is the model class for table "admin_email".
 *
 * The followings are the available columns in table 'admin_email':
 * @property integer $id
 * @property string $email1
 * @property string $email2
 * @property string $email3
 * @property string $email4
 * @property string $email5
 * @property integer $status
 */
class MemberExtra extends CActiveRecord
{
   
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
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
		return 'tbl_member_extras';
	}
    public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('name, contact_person, number, email, password, password_real, fax, website, twitter, facebok, pinterest, google, tagline, detail, logo, display_address, street_add, suburb, province, latitude, longitude, status, slug, date_added, date_updated, seo_title, seo_desc, seo_keywords', 'required'),
            array('type,value,member_id','required','on'=>'create,dashboard.index'),
         
		);
	}
    
    public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'value' => 'Value',
            'member_id' =>'Member Id'
		);
	}
    
    public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'member'=>array(self::BELONGS_TO,'Member','member_id'),
            
            //'jobs'=>array(self::HAS_MANY, 'Jobs', 'company_id'),
            //'services'=>array(self::HAS_MANY,'CompanyServices','company_id'),
     
		);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('email1',$this->email1,true);
		$criteria->compare('email2',$this->email2,true);
		$criteria->compare('email3',$this->email3,true);
		$criteria->compare('email4',$this->email4,true);
		$criteria->compare('email5',$this->email5,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

 }