<?php

/**
 * This is the model class for table "tbl_events_file".
 *
 * The followings are the available columns in table 'tbl_events_file':
 * @property integer $id
 * @property integer $event_id
 * @property string $file
 * @property string $mb
 * @property string $added_on
 * @property string $added_time
 */
class EventsFile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EventsFile the static model class
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
		return 'tbl_events_file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, file', 'required'),
			array('event_id', 'numerical', 'integerOnly'=>true),
			array('file, mb, added_on, added_time', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, file, mb, added_on, added_time', 'safe', 'on'=>'search'),
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
			'event_id' => 'Event',
			'file' => 'File',
			'mb' => 'Mb',
			'added_on' => 'Added On',
			'added_time' => 'Added Time',
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
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('mb',$this->mb,true);
		$criteria->compare('added_on',$this->added_on,true);
		$criteria->compare('added_time',$this->added_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}