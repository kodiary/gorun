<?php

/**
 * This is the model class for table "tbl_com_associations".
 *
 * The followings are the available columns in table 'tbl_com_associations':
 * @property integer $id
 * @property integer $company_id
 * @property integer $association_id
  */
class CompanyAssociations extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CompanyServices the static model class
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
		return 'tbl_com_associations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, association_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, association_id', 'safe', 'on'=>'search'),
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
            'associations'=>array(self::BELONGS_TO,'Associations','association_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company_id' => 'Company',
			'association_id' => 'Associations',
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
		$criteria->compare('association_id',$this->association_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getAssociationById($id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'association_id='.$id;
        return CompanyAssociations::model()->count($criteria);
    }
    
    public function listAssociations()
    {
        $associations = Associations::model()->findAll();
        return CHtml::listData($associations, 'id', 'ass_name');
    }
    
    public function getSelectedAssociations($companyId)
    {
        $criteria = new CDbCriteria;
        //$criteria->select = array('facility_id');
        $associations = CompanyAssociations::model()->findAllByAttributes(array('company_id'=>$companyId),"association_id!=0");
        $association_arr = array();
        if($associations){
            foreach($associations as $val)
            {
                $val->association_id;
                $association_arr[] = $val->association_id;
            }
        }
        if(is_array($association_arr))
            return $association_arr;
        else
            return false;
    }
}