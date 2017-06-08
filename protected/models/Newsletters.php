<?php
/**
 * This is the model class for table "tbl_newsletters".
 *
 * The followings are the available columns in table 'tbl_newsletters':
 * @property integer $id
 * @property integer $template_id
 * @property string $subject
 * @property string $pub_date
 * @property string $detail
 * @property integer $number
 * @property string $date_updated
 * @property integer $send_status
 * @property string $send_date
 * @property integer $recipients_no
 */
 
class Newsletters extends CActiveRecord
{
	public $maxColumn;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Newsletters the static model class
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
		return 'tbl_newsletters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            //array('template_id','required','on'=>'selectTemplate'),
			array('subject', 'required'),
			array('number, send_status, recipients_no', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>255),
			array('detail, number, date_updated, send_status, send_date, recipients_no, template_id, pub_date', 'safe'),
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
			'subject' => 'Subject',
			'pub_date' => 'Publish Date',
			'detail' => 'Newsletter Details',
			'number' => 'Number',
			'date_updated' => 'Date Updated',
			'send_status' => 'Send Status',
			'send_date' => 'Send Date',
			'recipients_no' => 'Recipients No',
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
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('pub_date',$this->pub_date,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('number',$this->number);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('send_status',$this->send_status);
		$criteria->compare('send_date',$this->send_date,true);
		$criteria->compare('recipients_no',$this->recipients_no);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function findmaxnumber()
	{
		$model = new Newsletters;
		$criteria=new CDbCriteria;
		$criteria->select='max(number) AS maxColumn';
		$row = $model->model()->find($criteria);
		return $row['maxColumn'];
	}
	public function getitems($nid,$itype)
	{
		$model1 = new NewsletterItems;
		$criteria=new CDbCriteria;
		$criteria->select ='item_id';
		$criteria->condition = "newsletter_id = '$nid' AND item_type = '$itype'";
		print_r($model1->model()->find($criteria));
	}
    public function getNewNewsletterNumber()
    {
       	$criteria=new CDbCriteria;
        $criteria->select='max(number) as maxColumn'; 
        $row =Newsletters::model()->find($criteria);
		return $row['maxColumn'];
    }
}