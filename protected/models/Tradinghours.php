<?php

/**
 * This is the model class for table "tradinghours".
 *
 * The followings are the available columns in table 'tradinghours':
 * @property integer $id
 * @property integer $company_id
 * @property string $MonFrom
 * @property string $MonTo
 * @property string $TueFrom
 * @property string $TueTo
 * @property string $WedFrom
 * @property string $WedTo
 * @property string $ThuFrom
 * @property string $ThuTo
 * @property string $FriFrom
 * @property string $FriTo
 * @property string $SatFrom
 * @property string $SatTo
 * @property string $SunFrom
 * @property string $SunTo
 * @property string $HolidaysFrom
 * @property string $HolidaysTo
 */
class Tradinghours extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tradinghours the static model class
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
		return 'tbl_tradinghours';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id', 'numerical', 'integerOnly'=>true),
			array('MonFrom, MonTo, TueFrom, TueTo, WedFrom, WedTo, ThuFrom, ThuTo, FriFrom, FriTo, SatFrom, SatTo, SunFrom, SunTo, HolidaysFrom, HolidaysTo,MonClosed,TueClosed,WedClosed,ThuClosed,FriClosed,SatClosed,SunClosed,HClosed', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, MonFrom, MonTo, TueFrom, TueTo, WedFrom, WedTo, ThuFrom, ThuTo, FriFrom, FriTo, SatFrom, SatTo, SunFrom, SunTo, HolidaysFrom, HolidaysTo, MonClosed,TueClosed,WedClosed,ThuClosed,FriClosed,SatClosed,SunClosed,HClosed', 'safe', 'on'=>'search'),
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
        /*
			'Id' => 'ID',
			'ResId' => 'Res',
			'MonFrom' => 'Mon From',
			'MonTo' => 'Mon To',
			'TueFrom' => 'Tue From',
			'TueTo' => 'Tue To',
			'WedFrom' => 'Wed From',
			'WedTo' => 'Wed To',
			'ThuFrom' => 'Thu From',
			'ThuTo' => 'Thu To',
			'FriFrom' => 'Fri From',
			'FriTo' => 'Fri To',
			'SatFrom' => 'Sat From',
			'SatTo' => 'Sat To',
			'SunFrom' => 'Sun From',
			'SunTo' => 'Sun To',
			'HolidaysFrom' => 'Holidays From',
			'HolidaysTo' => 'Holidays To',
            */
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
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('MonFrom',$this->MonFrom,true);
		$criteria->compare('MonTo',$this->MonTo,true);
		$criteria->compare('TueFrom',$this->TueFrom,true);
		$criteria->compare('TueTo',$this->TueTo,true);
		$criteria->compare('WedFrom',$this->WedFrom,true);
		$criteria->compare('WedTo',$this->WedTo,true);
		$criteria->compare('ThuFrom',$this->ThuFrom,true);
		$criteria->compare('ThuTo',$this->ThuTo,true);
		$criteria->compare('FriFrom',$this->FriFrom,true);
		$criteria->compare('FriTo',$this->FriTo,true);
		$criteria->compare('SatFrom',$this->SatFrom,true);
		$criteria->compare('SatTo',$this->SatTo,true);
		$criteria->compare('SunFrom',$this->SunFrom,true);
		$criteria->compare('SunTo',$this->SunTo,true);
		$criteria->compare('HolidaysFrom',$this->HolidaysFrom,true);
		$criteria->compare('HolidaysTo',$this->HolidaysTo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function timeTable(){
        return array(
        '1:00 AM'=>'1:00 AM',
        '1:30 AM'=>'1:30 AM',
        '2:00 AM' =>'2:00 AM',
        '2:30 AM' =>'2:30 AM',
        '3:00 AM'=>'3:00 AM',
        '3:30 AM' =>'3:30 AM',
        '4:00 AM'=>'4:00 AM',
        '4:30 AM'=>'4:30 AM',
        '5:00 AM'=>'5:00 AM',
        '5:30 AM'=>'5:30 AM',
        '6:00 AM'=>'6:00 AM',
        '6:30 AM'=>'6:30 AM',
        '7:00 AM' =>'7:00 AM',
        '7:30 AM' => '7:30 AM',
        '8:00 AM'=> '8:00 AM',
        '8:30 AM' => '8:30 AM',
        '9:00 AM'=>'9:00 AM',
        '9:30 AM' =>'9:30 AM',
        '10:00 AM'=>'10:00 AM',
        '10:30 AM'=>'10:30 AM',
        '11:00 AM'=>'11:00 AM',
        '11:30 AM'=>'11:30 AM',
        '12:00  PM' =>'12:00  PM',
        '12:30 PM'=>'12:30 PM',
        '1:00 PM'=>'1:00 PM',
        '1:30 PM'=>'1:30 PM',
        '2:00 PM' =>'2:00 PM',
        '2:30 PM' =>'2:30 PM',
        '3:00 PM'=>'3:00 PM',
        '3:30 PM' =>'3:30 PM',
        '4:00 PM'=>'4:00 PM',
        '4:30 PM'=>'4:30 PM',
        '5:00 PM'=>'5:00 PM',
        '5:30 PM'=>'5:30 PM',
        '6:00 PM'=>'6:00 PM',
        '6:30 PM'=>'6:30 PM',
        '7:00 PM' =>'7:00 PM',
        '7:30 PM' => '7:30 PM',
        '8:00 PM'=> '8:00 PM',
        '8:30 PM' => '8:30 PM',
        '9:00 PM'=>'9:00 PM',
        '9:30 PM' =>'9:30 PM',
        '10:00 PM'=>'10:00 PM',
        '10:30 PM'=>'10:30 PM',
        '11:00 PM'=>'11:00 PM',
        '11:30 PM'=>'11: 30 PM',
        '12:00 AM' =>'12:00 AM',
        '12:30 AM'=>'12:30 AM',
        'Late'=>'Late',
         );
    }
}