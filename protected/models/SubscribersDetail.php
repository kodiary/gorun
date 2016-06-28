<?php

/**
 * This is the model class for table "SubscribersDetail".
 *
 * The followings are the available columns in table 'tbl_subscribers_detail':
 * @property integer $id
 * @property integer $subscriber_id
 * @property integer $list_id
 * @property integer $company_id 
 */
class SubscribersDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SubscribersDetail the static model class
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
		return 'tbl_subscribers_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subscriber_id, list_id', 'required'),
			array('id, subscriber_id, list_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, subscriber_id, list_id,company_id', 'safe', 'on'=>'search'),
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
			'subscriber_id' => 'Subscriber',
			'list_id' => 'List',
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
		$criteria->compare('subscriber_id',$this->subscriber_id);
		$criteria->compare('list_id',$this->list_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function findBySubscriberId($id ='')
    {
        if($id)
        {
           return SubscribersDetail::model()->findAllByAttributes(array('subscriber_id'=>$id)); 
        }
        else
           return SubscribersList::model()->findAll();
    }

    public function deleteallbySubId($id)
    {
        SubscribersDetail::model()->deleteAllByAttributes(array('subscriber_id'=>$id));
        return true;
    }
    
    Public function getAllstates($list_id)
    {
       	$criteria=new CDbCriteria;
        $criteria->alias = 'sub';
        //$criteria->select=array('subscribe_newsletters');
        $criteria->join='INNER JOIN tbl_subscribers as list ON (list.id= sub.subscriber_id)';
        $criteria->join .='RIGHT OUTER JOIN company as com ON (sub.company_id=com.id)';
        $criteria->condition = "sub.list_id=".$list_id;
        
        return SubscribersDetail::model()->findAll($criteria);
    }
    
    
}