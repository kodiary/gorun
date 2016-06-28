<?php

/**
 * This is the model class for table "tbl_newsletter_items".
 *
 * The followings are the available columns in table 'tbl_newsletter_items':
 * @property integer $id
 * @property integer $newsletter_id
 * @property integer $item_type
 * @property integer $item_id
 */
class NewsletterItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NewsletterItems the static model class
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
		return 'tbl_newsletter_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('newsletter_id, item_type, item_id', 'required'),
			array('newsletter_id, item_type, item_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, newsletter_id, item_type, item_id', 'safe', 'on'=>'search'),
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
			'newsletter_id' => 'Newsletter',
			'item_type' => 'Item Type',
			'item_id' => 'Item',
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
		$criteria->compare('newsletter_id',$this->newsletter_id);
		$criteria->compare('item_type',$this->item_type);
		$criteria->compare('item_id',$this->item_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getItemsByType($newsletter_id,$type)
    {
        $criteria=new CDbCriteria;
        $criteria->condition="newsletter_id= $newsletter_id AND item_type=$type";
        $result = NewsletterItems::model()->findAll($criteria);
        $data=array();
        if($result)
        {
            foreach($result as $row)
            {
                $data[]=$row->item_id;
            }
            
        }
        return $data;
    }
    public function getAllNewsletterItemsByType($newsletter_id,$type)
    {
        $criteria=new CDbCriteria;
        $criteria->condition="newsletter_id= $newsletter_id AND item_type=$type";
        $result = NewsletterItems::model()->findAll($criteria);
        return $result;
    }
    
    public function deleteAllItemsByNewsletter($newsletter_id)
    {
        NewsletterItems::model()->deleteAllByAttributes(array('newsletter_id'=>$newsletter_id));
    }
    
}