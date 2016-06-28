<?php

/**
 * This is the model class for table "tbl_company_resouces".
 *
 * The followings are the available columns in table 'tbl_company_resouces':
 * @property integer $id
 * @property integer $company_id
 * @property integer $resource_id
 */
class CompanyResources extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CompanyResources the static model class
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
		return 'tbl_company_resouces';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, resource_id', 'required'),
			array('company_id, resource_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, resource_id', 'safe', 'on'=>'search'),
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
            'resources'=>array(self::BELONGS_TO,'Resources','resource_id'),
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
			'resource_id' => 'Resource',
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
		$criteria->compare('resource_id',$this->resource_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getResourceById($id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'resource_id='.$id;
        return self::model()->count($criteria);
    }
    
    public function listResources()
    {
        $resources = Resources::model()->findAllByAttributes(array('additional'=>0));
        return CHtml::listData($resources, 'id', 'resource_name');
    }
    
    public function getCompanyByResources($id)
    {
        $models=self::model()->findAllByAttributes(array('resource_id'=>$id));
        $companies = array();
        if($models)
        {
            foreach($models as $model)
            {
               $companies[]=$model->company_id; 
            }
        }
        return $companies;
    }
    
     public function getSelectedResources($companyId)
    {
        $resources = CompanyResources::model()->findAllByAttributes(array('company_id'=>$companyId),"resource_id!=0");
        $resource_arr = array();
        if($resources){
            foreach($resources as $val)
            {
                //echo $val->resource_id;
                $resource_arr[]= $val->resource_id;
                
            }
        }
        if(is_array($resource_arr))
            return $resource_arr;
        else
            return false;
    }
}