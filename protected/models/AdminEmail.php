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
class AdminEmail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminEmail the static model class
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
		return 'admin_email';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('email1, email2, email3, email4, email5, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
            array('email1, email2, email3, email4, email5', 'email'),
			array('email1, email2, email3, email4, email5', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email1, email2, email3, email4, email5, status', 'safe', 'on'=>'search'),
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
			'email1' => 'Email1',
			'email2' => 'Email2',
			'email3' => 'Email3',
			'email4' => 'Email4',
			'email5' => 'Email5',
			'status' => 'Status',
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
    public function getAdminEmails()
    {
        return self::model()->findByPk(1);
    }
}