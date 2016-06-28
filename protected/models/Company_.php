<?php

/**
 * This is the model class for table "tbl_company".
 *
 * The followings are the available columns in table 'tbl_company':
 * @property integer $id
 * @property string $name
 * @property string $contact_person
 * @property string $number
 * @property string $email
 * @property string $password
 * @property string $password_real
 * @property string $fax
 * @property string $website
 * @property string $twitter
 * @property string $facebok
 * @property string $pinterest
 * @property string $google
 * @property string $tagline
 * @property string $detail
 * @property string $logo
 * @property string $display_address
 * @property string $postal_address
 * @property string $street_add
 * @property string $suburb
 * @property integer $province
 * @property double $latitude
 * @property double $longitude
 * @property integer $opentimes_type
 * @prooperty string $opentimes
 * @property integer $status
 * @property string $slug
 * @property string $date_added
 * @property string $date_updated
 * @property string $seo_title
 * @property string $seo_desc
 * @property string $seo_keywords
 * @property string $contact_clicked
 * @property string $total_logins
 * @property string $editor_type
 */
class Company extends CActiveRecord
{
    public $basic_editor;
    public $repeat_password;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
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
		return 'tbl_company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('name, contact_person, number, email, password, password_real, fax, website, twitter, facebok, pinterest, google, tagline, detail, logo, display_address, street_add, suburb, province, latitude, longitude, status, slug, date_added, date_updated, seo_title, seo_desc, seo_keywords', 'required'),
            array('name,tagline,number,email,detail,province,street_add,postal_address,display_address','required','on'=>'companyInfo'),
            array('contact_person,opentimes_type,opentimes,latitude,longitude,logo,fax,slug,status,suburb,seo_title,seo_desc,seo_keywords,date_added,date_updated','safe','on'=>'companyInfo'),
            array('email','email','on'=>'companyInfo,signup,editlogin,adminSignup'),
            array('email','unique','on'=>'companyInfo,signup,editlogin,adminSignup'),
            array('name','unique','on'=>'signup,adminSignup'),
            array('website,twitter,facebook,pinterest,google','url', 'defaultScheme' => 'http','on'=>'companyInfo'),
            array('status,rigger,valid_until,never_expire','safe','on'=>'updatestatus'),
            array('seo_title,seo_desc,seo_keywords,id','safe','on'=>'seo'),
            array('name,contact_person,password_real,password,number,email','required','on'=>'signup,adminSignup,editlogin'),
            array('repeat_password', 'compare', 'compareAttribute'=>'password_real','on'=>'signup,adminSignup,editlogin'),
			array('province, status', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude', 'numerical'),
            array('contact_clicked,date_updated,editor_type','safe'),
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
            'membership'=>array(self::HAS_MANY,'CompanyMember','company_id'),
            'articles'=>array(self::HAS_MANY, 'Articles', 'company_id'),
            'jobs'=>array(self::HAS_MANY, 'Jobs', 'company_id'),
            'services'=>array(self::HAS_MANY,'CompanyServices','company_id'),
     
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Company Name',
			'contact_person' => 'Contact Person',
			'number' => 'Contact Number',
			'email' => 'Contact E-mail',
			'password' => 'Password',
			'password_real' => 'Password',
            'repeat_password'=>'Repeat Password',
			'fax' => 'Fax Number',
			'website' => 'Website',
			'twitter' => 'Twitter',
			'facebok' => 'Facebok',
			'pinterest' => 'Pinterest',
			'google' => 'Google+',
			'tagline' => 'Tag Line',
			'detail' => 'Description',
			'logo' => 'Company Sign/Logo',
			'display_address' => 'Display Address',
            'postal_address' => 'Postal Address',
			'street_add' => 'Street Address 1',
			'suburb' => 'Suburb or Town',
			'province' => 'Province',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'status' => 'Status',
            'rigger' =>'Rigger/Applicator',
            'valid_until'=>'Valid Until',
            'never_expire'=>'',
			'slug' => 'Slug',
			'date_added' => 'Date Added',
			'date_updated' => 'Date Updated',
			'seo_title' => 'Seo Title',
			'seo_desc' => 'Seo Desc',
			'seo_keywords' => 'Seo Keywords',
            'opentimes_type'=>'Trading Hours',
            'opentimes'=>'',
            'contact_clicked'=>'Total Contact Clicked',
            'total_logins' => 'Total Logins',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('contact_person',$this->contact_person,true);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('password_real',$this->password_real,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('twitter',$this->twitter,true);
		$criteria->compare('facebok',$this->facebok,true);
		$criteria->compare('pinterest',$this->pinterest,true);
		$criteria->compare('google',$this->google,true);
		$criteria->compare('tagline',$this->tagline,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('display_address',$this->display_address,true);
		$criteria->compare('street_add',$this->street_add,true);
		$criteria->compare('suburb',$this->suburb,true);
		$criteria->compare('province',$this->province);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('status',$this->status);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_desc',$this->seo_desc,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
        $criteria->compare('contact_clicked',$this->contact_clicked,true);
        $criteria->compare('total_logins',$this->total_logins,true);
        $criteria->compare('editor_type',$this->editor_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function companyInfo($companyId)
    {
        return Company::model()->findByPk($companyId);
    }
    
    public function getAll()
    {
        $criteria = new CDbCriteria;
        $criteria->select = array('id, name');
        $criteria->order = 'name asc';
        $rests = Company::model()->findAll($criteria);
        return CHtml::listData($rests, 'id', 'name');
    }
    
    public function createSeo($name,$desc,$address='')
    {
       $seo=array();
       $seoTile=$name." in Directory | EXSA - Exhibition Association of Southern Africa";

       $seoKey=$name;
       if($address!="")$seoKey.=", ".$address;
       $seoKey.=", directory, EXSA, south africa";
       
       $seo['title']=$seoTile;
       $seo['desc']=CommonClass::getCleanData($desc,160);
       $seo['keywords']=$seoKey;
       return $seo;
    }
    
    public function getAllActiveCompany()
    {
        $result = Company::model()->findAll("status=1 AND (valid_until >= curdate() OR never_expire=1)");
        $company = array();
        foreach($result as $val){
            $company[] = $val->id;
        }
        return $company; 
    }
    
    public function getAllActiveCompanyForSpecials()
    {
        $result = Company::model()->findAll("status=1 AND rigger!=1 AND (valid_until >= curdate() OR never_expire=1)");
        $company = array();
        foreach($result as $val){
            $company[] = $val->id;
        }
        return $company; 
    }
    
    public function Image($filename, $size='thumb', $alt='')
    {
        $alt = htmlspecialchars_decode($alt);
        $baseUrl = Yii::app()->baseUrl;
        $basePath = Yii::app()->basePath;
        if(file_exists($basePath.'/../images/frontend/'.$size.'/'.$filename) && $filename)
            return CHtml::image($baseUrl.'/images/frontend/'.$size.'/'.$filename, $alt);
        else{
            if($size=='main')
                return CHtml::image($baseUrl.'/images/no_image_large.jpg', $alt);
            else if($size=='thumb')
                return CHtml::image($baseUrl.'/images/no_image_medium.jpg');
            else
                return CHtml::image($baseUrl.'/images/no_image_random.jpg', $alt);    
        }
    }
    
    public function exists_company($slug)
    {
        if(Company::model()->findByAttributes(array('slug'=>$slug))) return true;
        else return false;
    }
    
    public function isCompleteAllSection($companyId)
    {
        $model=self::model()->findByPk($companyId);
        if($model->rigger==1) // light listing
        {
            if(self::isCompleteCompanyInfoTab($companyId) && self::isCompleteProdSerBrandAssoc($companyId) && self::isCompleteGallery($companyId) && self::isCompleteVideo($companyId))
                return true;
            else
                return false;
        }
        else // full/complete listing
        {
           if(self::isCompleteCompanyInfoTab($companyId) && self::isCompleteBranches($companyId) && self::isCompleteProdSerBrandAssoc($companyId) && self::isCompleteFeatured($companyId) && self::isCompleteBrochures($companyId) && self::isCompleteGallery($companyId) && self::isCompleteVideo($companyId) && self::isCompleteSpecials($companyId))
                return true;
            else
                return false; 
        }
    }
        
    public function isCompleteCompanyInfoTab($companyId)
    {
       $result = Company::model()->find('id = '.$companyId.' AND tagline<>""') ;
       if($result)return true;
       else return false;
    }
    
    public function isCompleteBranches($companyId)
    {
        $result = Branches::model()->findAll('company_id = '.$companyId) ;
        if($result)return true;
        else return false; 
    }
    
    public function isCompleteProdSerBrandAssoc($companyId)
    {
        $products = CompanyProducts::model()->findAll('company_id = '.$companyId);
        $services = CompanyServices::model()->findAll('company_id = '.$companyId);
        $brands = CompanyBrands::model()->findAll('company_id = '.$companyId);     
        $associations = CompanyAssociations::model()->findAll('company_id = '.$companyId);
        
        if($products || $services || $brands || $associations) return true;
        else return false;
    }

    public function isCompleteFeatured($companyId)
    {
        $result = Featured::model()->findAll('company_id = '.$companyId);        
        if($result)return true;
        else return false;
    }
    
    public function isCompleteBrochures($companyId)
    {
        $result = Brochures::model()->findAll('company_id = '.$companyId) ;
        if($result)return true;
        else return false; 
    }
    
    public function isCompleteGallery($companyId)
    {
        $result = Gallery::model()->findAll('company_id='.$companyId) ;
        if($result)return true;
        else return false; 
    }
    
    public function isCompleteVideo($companyId)
    {
        $result = Videos::model()->findAll('company_id='.$companyId) ;
        if($result)return true;
        else return false; 
    }
    
    public function isCompleteSpecials($companyId)
    {
        $result = Specials::model()->findAll('company_id = '.$companyId) ;
        if($result)return true;
        else return false; 
    }
    
    public function getAllCompany()
    {
        $criteria = new CDbCriteria;
        $criteria->select = array('id, name');
        $criteria->order = 'name asc';
        $company = Company::model()->findAll($criteria);
        return $company;
    }
    
    public function getVenues()
    {
        $criteria = new CDbCriteria;
        $criteria->join = "LEFT JOIN tbl_company_member on tbl_company_member.company_id=t.id";
        $criteria->condition = "tbl_company_member.member_id=3";
        $criteria->order = 't.name asc';
        return Company::model()->findAll($criteria);
    }
    
    public function getOrganizers()
    {
        $criteria = new CDbCriteria;
        $criteria->join = "LEFT JOIN tbl_company_member on tbl_company_member.company_id=t.id";
        $criteria->condition = "tbl_company_member.member_id=1";
        $criteria->order = 't.name asc';
        return Company::model()->findAll($criteria);
    }
}