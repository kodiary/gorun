<?php

/**
 * This is the model class for table "tbl_services".
 *
 * The followings are the available columns in table 'tbl_services':
 * @property integer $id
 * @property string $service_name
 * @property integer $additional
 * @property string $slug
 * @property integer $display_order
 */
class Services extends CActiveRecord
{
    public $max;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Services the static model class
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
		return 'tbl_services';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('service_name', 'required'),
			array('additional', 'numerical', 'integerOnly'=>true),
			array('service_name, slug', 'length', 'max'=>100),
            array('additional, slug', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, service_name, additional, slug, display_order', 'safe', 'on'=>'search'),
		);
	}

    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'service_name' => 'Service Name',
			'additional' => 'IsAdditional',
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
		$criteria->compare('service_name',$this->service_name,true);
		$criteria->compare('additional',$this->additional);
		$criteria->compare('slug',$this->slug,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function serviceVal($id)
    {
        return Services::model()->findByPk($id)->service_name;
    }
    public function get_id_by_slug($slug)
    {
        $model=self::model()->find("slug='$slug'");
        if($model) return $model->id;
        else return false;
    }
    
   public function getAdditionalServicesByCompany($companyId)
    {
        $companyServices = CompanyServices::model()->findAllByAttributes(array('company_id'=>$companyId));
        if($companyServices)
        {
            $services = '';
            foreach($companyServices as $cservices)
            {
                $serviceModel = Services::model()->findByPk($cservices->service_id);
                if($serviceModel && $serviceModel->additional==1)
                {
                    if($services=='') $services = $serviceModel->service_name;
                    else $services = $services.','.$serviceModel->service_name;
                }
            }            
        }
        if($services) return $services;
        else return null;
    }
        
    public function deleteCompanyAdditionalServices($companyId)
    {
        $companyServices = CompanyServices::model()->findAllByAttributes(array('company_id'=>$companyId));
        if($companyServices)
        {
            foreach($companyServices as $cservices)
            {
                $service_type = Services::model()->findByPk($cservices->service_id)->additional;
                if($service_type==1)
                {
                    CompanyServices::model()->deleteByPk($cservices->id);
                    Services::model()->deleteByPk($cservices->service_id);
                }
            }            
        }
    } 
    
    //get selected services with additional
    public function getServicesByCompany($companyId)
    {
        $criteria = new CDbCriteria;
		$criteria->join = 'LEFT JOIN tbl_com_services ON tbl_com_services.service_id = t.id';
        $criteria->condition = 'tbl_com_services.company_id = '.$companyId;
        $criteria->order = 'service_name ASC';
        
        $services = Services::model()->findAll($criteria);        
        return $services;
    }
    public function getAll()
    {
        $criteria = new CDbCriteria;
        //$criteria->condition = 't.additional = 0';
        $criteria->order = 'service_name ASC';
        return self::model()->findAll($criteria);
    }
    public function getAdditional()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 't.additional = 1';
        $criteria->order = 'service_name ASC';
        return self::model()->findAll($criteria);
    }
    
    public function getmaxOrder()
    {                 
        $criteria = new CDbCriteria;
        $criteria->select='MAX(display_order) as max';
        
        return self::model()->find($criteria)->max;
    }
    
    public function getTaggedServices()
    {
        $criteria = new CDbCriteria;
        $criteria->select = "DISTINCT t.id, t.service_name, t.slug";
        $criteria->join = "LEFT JOIN tbl_com_services ON tbl_com_services.service_id=t.id";
        $criteria->join .= " LEFT JOIN tbl_company ON tbl_company.id=tbl_com_services.company_id";
        $criteria->condition = "t.additional=0 AND tbl_company.status=1";
        $criteria->order = "service_name ASC";
        return self::model()->findAll($criteria);
    }
}