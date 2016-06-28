<?php

/**
 * This is the model class for table "tbl_products".
 *
 * The followings are the available columns in table 'tbl_products':
 * @property integer $id
 * @property string $product_name
 * @property integer $additional
 * @property string $slug
 */
class Products extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Products the static model class
	 */
     public $name,$section;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('product_name', 'required'),
			array('additional', 'numerical', 'integerOnly'=>true),
			array('product_name, slug', 'length', 'max'=>100),
            array('additional, slug', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_name, additional, slug', 'safe', 'on'=>'search'),
		);
	}

    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_name' => 'Product Name',
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
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('additional',$this->additional);
		$criteria->compare('slug',$this->slug,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function productVal($id)
    {
        return Products::model()->findByPk($id)->product_name;
    }
    public function get_id_by_slug($slug)
    {
        $model=self::model()->find("slug='$slug'");
        if($model) return $model->id;
        else return false;
    }

   public function getAdditionalProductsByCompany($companyId)
    {
        $products = '';
        $companyProducts = CompanyProducts::model()->findAllByAttributes(array('company_id'=>$companyId));
        if($companyProducts)
        {
            foreach($companyProducts as $cproducts)
            {
                $productModel = Products::model()->findByPk($cproducts->product_id);
                if($productModel && $productModel->additional==1)
                {
                    if($products=='') $products = $productModel->product_name;
                    else $products = $products.','.$productModel->product_name;
                }
            }            
        }
        if($products) return $products;
        else return null;
    }
        
    public function deleteCompanyAdditionalProducts($companyId)
    {
        $companyProducts = CompanyProducts::model()->findAllByAttributes(array('company_id'=>$companyId));
        if($companyProducts)
        {
            foreach($companyProducts as $cproducts)
            {
                $product_type = Products::model()->findByPk($cproducts->product_id)->additional;
                if($product_type==1)
                {
                    CompanyProducts::model()->deleteByPk($cproducts->id);
                    Products::model()->deleteByPk($cproducts->product_id);
                }
            }            
        }
    }
    
    //get selected products with additional
    public function getProductsByCompany($companyId)
    {
        $criteria = new CDbCriteria;
		$criteria->join = 'LEFT JOIN tbl_com_products ON tbl_com_products.product_id = t.id';
        $criteria->condition = 'tbl_com_products.company_id = '.$companyId;
        $criteria->order = 'product_name ASC';
        
        $products = Products::model()->findAll($criteria);        
        return $products;
    }
    public function getAll()
    {
        $criteria = new CDbCriteria;
        //$criteria->condition = 't.additional = 0';
        $criteria->order = 'product_name ASC';
        return self::model()->findAll($criteria);
    }
    public function getAdditional()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 't.additional = 1';
        $criteria->order = 'product_name ASC';
        return self::model()->findAll($criteria);
    }
}