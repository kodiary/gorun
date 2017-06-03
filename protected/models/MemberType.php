<?php

/**
 * This is the model class for table "tbl_member_type".
 *
 * The followings are the available columns in table 'tbl_member_type':
 * @property integer $id
 * @property string $type_name
 * @property string $slug
 */
class MemberType extends CActiveRecord
{
    public $max;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MemberType the static model class
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
		return 'tbl_member_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_name, slug', 'required'),
			array('type_name, slug', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type_name, slug, display_order', 'safe', 'on'=>'search'),
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
		            'membership2'=>array(self::HAS_MANY,'CompanyMember','member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type_name' => 'Type Name',
			'slug' => 'Slug',
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
		$criteria->compare('type_name',$this->type_name,true);
		$criteria->compare('slug',$this->slug,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getmaxOrder()
    {                 
        $criteria = new CDbCriteria;
        $criteria->select='MAX(display_order) as max';
        
        return self::model()->find($criteria)->max;
    }
    
    public function typeName($id)
    {
       return self::model()->findByAttributes(array('id'=>$id))->type_name; 
    }
    public function listMembers()
    {
        $members = self::model()->findAll();
        return CHtml::listData($members, 'id', 'type_name');
    }
}