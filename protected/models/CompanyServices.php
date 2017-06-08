<?php

/**
 * This is the model class for table "tbl_com_services".
 *
 * The followings are the available columns in table 'tbl_com_services':
 * @property integer $id
 * @property integer $company_id
 * @property integer $service_id
 */
class CompanyServices extends CActiveRecord
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
		return 'tbl_com_services';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, service_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, service_id', 'safe', 'on'=>'search'),
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
            'services'=>array(self::BELONGS_TO,'Services','service_id'),
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
			'service_id' => 'Services',
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
		$criteria->compare('service_id',$this->service_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getServiceById($id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'service_id='.$id;
        return CompanyServices::model()->count($criteria);
    }
    
    public function listServices()
    {
        $services = Services::model()->findAllByAttributes(array('additional'=>0));
        return CHtml::listData($services, 'id', 'service_name');
    }
    
    public function getSelectedServices($companyId)
    {
        $services = CompanyServices::model()->findAllByAttributes(array('company_id'=>$companyId),"service_id!=0");
        $service_arr = array();
        if($services){
            foreach($services as $val)
            {
                $service_arr[] = $val->service_id;
            }
        }
        if(is_array($service_arr))
            return $service_arr;
        else
            return false;
    }
    
    //get selected services and additional
    public function getBothServicesByCompany($companyId)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 't.company_id='.$companyId;
        $services = CompanyServices::model()->findAll($criteria);
        return $services;
    }
    public function getCompanyByService($service_id)
    {
        $models=self::model()->findAllByAttributes(array('service_id'=>$service_id));
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
    
    public function countCompanyByService($service_id)
    {
        return self::model()->countByAttributes(array('service_id'=>$service_id));
    } 
}