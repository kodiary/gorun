<?php

/**
 * This is the model class for table "tbl_com_products".
 *
 * The followings are the available columns in table 'tbl_com_products':
 * @property integer $id
 * @property integer $company_id
 * @property integer $product_id
 */
class CompanyProducts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CompanyProducts the static model class
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
		return 'tbl_com_products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, product_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, product_id', 'safe', 'on'=>'search'),
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
            'products'=>array(self::BELONGS_TO,'Products','product_id'),
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
			'product_id' => 'Products',
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
		$criteria->compare('product_id',$this->product_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getProductById($id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'product_id='.$id;
        return CompanyProducts::model()->count($criteria);
    }
    public function listProducts()
    {
        $products = Products::model()->findAllByAttributes(array('additional'=>0));
        return CHtml::listData($products, 'id', 'product_name');
    }
    
    public function getSelectedProducts($companyId)
    {
        $products = CompanyProducts::model()->findAllByAttributes(array('company_id'=>$companyId),"product_id!=0");
        $product_arr = array();
        if($products){
            foreach($products as $val)
            {
                $product_arr[] = $val->product_id;
            }
        }
        if(is_array($product_arr))
            return $product_arr;
        else
            return false;
    }
    public function getCompanyByProduct($product_id)
    {
        $models=self::model()->findAllByAttributes(array('product_id'=>$product_id));
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
}