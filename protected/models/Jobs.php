<?php

/**
 * This is the model class for table "tbl_jobs".
 *
 * The followings are the available columns in table 'tbl_jobs':
 * @property integer $id
 * @property integer $company_id
 * @property string $title
 * @property string $desc
 * @property string $posted_date
 * @property string $date_updated
 * @property integer $visible
 * @property integer $display_order
 * @property string $slug
 * @property integer $readcount
 * @property string $editor_type
 */
class Jobs extends CActiveRecord
{
    public $basic_editor;
    public $maxorder;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Jobs the static model class
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
		return 'tbl_jobs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, title, desc, visible', 'required'),
			array('company_id, visible, display_order, readcount', 'numerical', 'integerOnly'=>true),
			array('title, slug', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, title, desc, posted_date, date_updated, visible, display_order, slug, readcount', 'safe', 'on'=>'search'),
            array('editor_type','safe'),
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
            'jobs'=>array(self::BELONGS_TO, 'Company', 'company_id'),
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
			'title' => 'Job Title',
			'desc' => 'Job Description',
			'posted_date' => 'Posted Date',
			'visible' => 'Visible',
			'display_order' => 'Display Order',
			'slug' => 'Slug',
			'readcount' => 'Readcount',
            'editor_type' => 'Editor Type'
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('posted_date',$this->posted_date,true);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('display_order',$this->display_order);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('readcount',$this->readcount);
        $criteria->compare('editor_type',$this->editor_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    /**
    * return  the max display order value
    */
    public function maxDisplayVal($companyId)
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'max(display_order) AS $maxorder';
        $criteria->condition = 'company_id='.$companyId;
        $val = Jobs::model()->find($criteria);
        if($val->maxorder)
            return $val->maxorder+1;
        else
            return 0;
    }
    
    # check for max 3 display of jobs
    public function allowMax3display($companyId)
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition('company_id='.$companyId.' AND visible=1 ');
        $max = Jobs::model()->count($criteria);
        if($max< 3)
            return 1;//display off
        else
            return 0;//display on
    }
    
	public function countJobsOfCompany()
    {
        $criteria = new CDbCriteria;
        $criteria->select = array('name', 'slug', 'count(jobs.company_id) as count');
        //$criteria->condition='articles.visible=1';
        $criteria->with=array('jobs');
        $criteria->group = 'jobs.company_id';
        return Company::model()->findAll($criteria); 
    }
    
    public function countJobsByCompany($company_id)
    {
       $criteria= new CDbCriteria;
       $criteria->addCondition("company_id=$company_id");
       return Jobs::model()->count($criteria);
    }
    
    public function get_jobs_by_slug($slug)
    {
        return Jobs::model()->findByAttributes(array('slug'=>$slug));
    }  
    
    public function countJobsByProvince($province)
    {
        $criteria = new CDbCriteria;
        //$criteria->select = array('name', 'slug', 'count(jobs.company_id) as count');
        $criteria->condition="t.visible='1'";
        $criteria->addCondition("province=$province");
        $criteria->with='jobs';
        return Jobs::model()->count($criteria); 
    }
}