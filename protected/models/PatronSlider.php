<?php

/**
 * This is the model class for table "tbl_patron_slider".
 *
 * The followings are the available columns in table 'tbl_patron_slider':
 * @property integer $id
 * @property string $slide_link
 * @property string $image
 * @property integer $target
 * @property integer $display_order
 * @property integer $count_click
 */
class PatronSlider extends CActiveRecord
{
    public $display_max;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PatronSlider the static model class
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
		return 'tbl_patron_slider';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('slide_link, image, target, display_order, count_click', 'safe'),
			array('target, display_order, count_click', 'numerical', 'integerOnly'=>true),
			array('slide_link, image', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, slide_link, image, target, display_order, count_click', 'safe', 'on'=>'search'),
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
			'slide_link' => 'Link (optional)',
			'image' => 'Image',
			'target' => 'Open In',
			'display_order' => 'Display Order',
			'count_click' => 'Count Click',
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
		$criteria->compare('slide_link',$this->slide_link,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('target',$this->target);
		$criteria->compare('display_order',$this->display_order);
		$criteria->compare('count_click',$this->count_click);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function displayMax()
    {
        $max_val = PatronSlider::model()->find(array('select'=>'max(display_order) as display_max'));
        $max = $max_val->display_max;
        if(empty($max))
            $max = 1;
        return $max+1;
    }
    
    public function countClicks($id)
    {
        return PatronSlider::model()->find('id='.$id)->count_click;
    }
    
    public function getMaxId()
    {
       $max_val = PatronSlider::model()->find(array('select'=>'max(id) as display_max'));
        $max = $max_val->display_max;
        if(empty($max))
            $max = 0;
        return $max;
    }
}