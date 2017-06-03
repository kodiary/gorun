<?php

/**
 * This is the model class for table "tbl_review".
 *
 * The followings are the available columns in table 'tbl_review':
 * @property integer $id
 * @property integer $user_id
 * @property integer $event_id
 * @property integer $rate
 * @property string $review
 * @property string $review_date
 * @property string $review_time
 */
class Review extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Review the static model class
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
		return 'tbl_review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, event_id, rate, review_date, review_time', 'required'),
			array('user_id, event_id, rate', 'numerical', 'integerOnly'=>true),
			array('review_time', 'length', 'max'=>255),
			array('review', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, event_id, rate, review, review_date, review_time', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'event_id' => 'Event',
			'rate' => 'Rate',
			'review' => 'Review',
			'review_date' => 'Review Date',
			'review_time' => 'Review Time',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('review',$this->review,true);
		$criteria->compare('review_date',$this->review_date,true);
		$criteria->compare('review_time',$this->review_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function resultCountbyUser($user_id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id='.$user_id;
        return self::model()->count($criteria);
        
    }
}