<?php

/**
 * This is the model class for table "tbl_com_specials".
 *
 * The followings are the available columns in table 'tbl_com_specials':
 * @property integer $id
 * @property integer $company_id
 * @property integer $special_id
 * @property integer $product_id
 * @property integer $service_id
 * @property string $additional
 */
class CompanySpecials extends CActiveRecord
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
		return 'tbl_com_specials';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            //array('product_id,service_id','required'),
			array('company_id, special_id, product_id, service_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, special_id, product_id, service_id', 'safe', 'on'=>'search'),
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
            'specials'=>array(self::BELONGS_TO,'Specials','special_id'),
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
            'special_id' => 'Special',
            'product_id' => 'Product',
			'service_id' => 'Service',
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
        $criteria->compare('special_id',$this->company_id);
        $criteria->compare('product_id',$this->company_id);
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
    
    //specials products
    public function listSpecialsProducts($companyId)
    {
        $criteria = new CDbCriteria;
        $criteria->join = 'LEFT JOIN tbl_com_products ON tbl_com_products.product_id=t.id';
        $criteria->condition = 'tbl_com_products.company_id='.$companyId.' AND tbl_com_products.product_id!=0';
        
        $products = Products::model()->findAll($criteria);
        return CHtml::listData($products, 'id', 'product_name');
    }
    
    public function getSelectedSpecialsProducts($companyId)
    {
        $criteria = new CDbCriteria;
        //$criteria->select = array('facility_id');
        $specials = CompanySpecials::model()->findAllByAttributes(array('company_id'=>$companyId),'product_id!=0');
        $special_arr = array();
        if($specials){
            foreach($specials as $val)
            {
                $special_arr[] = $val->product_id;
            }
        }
        if(is_array($special_arr))
            return $special_arr;
        else
            return false;
    }
    
    //specials services
    public function listSpecialsServices($companyId)
    {
        $criteria = new CDbCriteria;
        $criteria->join = 'LEFT JOIN tbl_com_services ON tbl_com_services.service_id=t.id';
        $criteria->condition = 'tbl_com_services.company_id='.$companyId.' AND tbl_com_services.service_id!=0';
        
        $services = Services::model()->findAll($criteria);
        return CHtml::listData($services, 'id', 'service_name');
    }
    
    public function getSelectedSpecialsServices($companyId)
    {
        $criteria = new CDbCriteria;
        //$criteria->select = array('facility_id');
        $specials = CompanySpecials::model()->findAllByAttributes(array('company_id'=>$companyId),'service_id!=0');
        $special_arr = array();
        if($specials){
            foreach($specials as $val)
            {
                $special_arr[] = $val->service_id;
            }
        }
        if(is_array($special_arr))
            return $special_arr;
        else
            return false;
    }
    public function getAdditionalServicesByCompany($companyId)
    {
        $model = CompanyServices::model()->findAllByAttributes(array('company_id'=>$companyId,'service_id'=>0));
        $services='';
        foreach($model as $addservices)
        {
            if($services=='') $services = $addservices->additional;
            else $services = $services.','.$addservices->additional;
        }
        if($services) return $services;
        else return null;
    }
    public function getSpecialsCountByProduct($product_id)
    {
        $criteria = new CDbCriteria;
        $criteria->join = 'LEFT JOIN tbl_specials on tbl_specials.id=t.special_id LEFT JOIN  tbl_company c on tbl_specials.company_id=c.id';
        $criteria->condition = 'tbl_specials.status=1 AND t.product_id='.$product_id.' AND tbl_specials.expiry_date>=CURDATE() AND c.status=1 AND c.rigger!=1 AND (c.valid_until >= curdate() OR c.never_expire=1)';
        $model = self::model()->findAll($criteria);
        return count($model);
    }
    public function getSpecialsCountByService($service_id)
    {
        $criteria = new CDbCriteria;
        $criteria->join = 'LEFT JOIN tbl_specials on tbl_specials.id=t.special_id LEFT JOIN  tbl_company c on tbl_specials.company_id=c.id';
        $criteria->condition = 'tbl_specials.status=1 AND t.service_id='.$service_id.' AND tbl_specials.expiry_date>=CURDATE() AND c.status=1 AND c.rigger!=1 AND (c.valid_until >= curdate() OR c.never_expire=1)';
        $model = self::model()->findAll($criteria);
        return count($model);        
    }
    public function getSpecialsByProduct($product_id)
    {
        $models=self::model()->findAllByAttributes(array('product_id'=>$product_id));
        $specials = array();
        if($models)
        {
            foreach($models as $model)
            {
                $specials[]=$model->special_id;  
            }
        } 
        return $specials;
    }
    public function getSpecialsByService($service_id)
    {
        $models=self::model()->findAllByAttributes(array('service_id'=>$service_id));
        $specials = array();
        if($models)
        {
            foreach($models as $model)
            {
               $specials[]=$model->special_id; 
            }
        }
        return $specials;
    }
    public function getProductBySpecial($spec_id)
    {
       $model=self::model()->find('special_id = '.$spec_id. ' AND product_id!=0');
       if($model)return $model->product_id;
       else return false;
    }
    public function getServiceBySpecial($spec_id)
    {
        $model=self::model()->find('special_id = '.$spec_id. ' AND service_id!=0');
        if($model)return $model->service_id;
        else return false;
    }
}