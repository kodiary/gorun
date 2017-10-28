<?php

/**
 * This is the model class for table "tbl_slideshow".
 *
 * The followings are the available columns in table 'tbl_slideshow':
 * @property integer $id
 * @property string $slide_link
 * @property string $image
 * @property string caption
 * @property string sub_caption
 * @property integer $target
 * @property integer $display_order
 * @property integer $count_click
 * @property string $transition
 * @property integer $slot_amount
 * @property string $navigation_type
 * @property string $navigation_arrows
 * @property string $navigation_style
 */
class Slideshow extends CActiveRecord
{
    public $display_max;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Slideshow the static model class
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
		return 'tbl_slideshow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('slide_link, image, caption, sub_caption, target, display_order, count_click', 'safe'),
			array('target, display_order, count_click, slot_amount', 'numerical', 'integerOnly'=>true),
			array('slide_link, image', 'length', 'max'=>100),
            //array('slide_link', 'url', 'defaultScheme' => 'http'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, slide_link, image, caption, sub_caption, target, display_order, count_click', 'safe', 'on'=>'search'),
            array('transition, slot_amount, navigation_type, navigation_arrows, navigation_style', 'safe'),
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
            'caption' =>'Caption',            
            'sub_caption' =>'Sub-Caption',
			'target' => 'Open In',
			'display_order' => 'Display Order',
			'count_click' => 'Count Click',
            'transition' => 'Transition',
            'slot_amount' => 'Slot Amount',
            'navigation_type' => 'Navigation Type',
            'navigation_arrows' => 'Navigation Arrows',
            'navigation_style' => 'Navigation Style',
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
        $criteria->compare('caption',$this->caption,true);
        $criteria->compare('sub_caption',$this->caption,true);        
		$criteria->compare('target',$this->target);
		$criteria->compare('display_order',$this->display_order);
		$criteria->compare('count_click',$this->count_click);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function displayMax()
    {
        $max_val = Slideshow::model()->find(array('select'=>'max(display_order) as display_max'));
        $max = $max_val->display_max;
        if(empty($max))
            $max = 1;
        return $max+1;
    }
    public function countClicks($id)
    {
        return Slideshow::model()->find('id='.$id)->count_click;
    }
    
    public function getMaxId()
    {
       $max_val = Slideshow::model()->find(array('select'=>'max(id) as display_max'));
        $max = $max_val->display_max;
        if(empty($max))
            $max = 0;
        return $max;
    }
}
