<?php

/**
 * This is the model class for table "tbl_articles".
 *
 * The followings are the available columns in table 'tbl_articles':
 * @property integer $id
 * @property integer $company_id
 * @property string $title
 * @property string $detail
 * @property string $publish_date
 * @property string $date_added
 * @property string $date_updated
 * @property integer $is_approved
 * @property integer $visible
 * @property integer $readcount
 * @property string $keywords
 * @property string $seo_title
 * @property string $seo_desc
 * @property string $slug
 * @property string $common_tags
 * @property integer $comment_option
 * @property string $editor_type
 * @property integer $media_post
 * @property integer $fb_post
 */
class Articles extends CActiveRecord
{
    public $basic_editor;
    public $maxColumn;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Articles the static model class
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
		return 'tbl_articles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('title, publish_date, detail, comment_option, visible', 'required'),
			array('company_id, is_approved, visible, readcount, comment_option', 'numerical', 'integerOnly'=>true),
			array('title, keywords, seo_title, seo_desc, slug', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
            array('id, company_id, title, detail, publish_date, date_added, date_updated, is_approved, visible, readcount, keywords, seo_title, seo_desc, slug, common_tags, editor_type, media_post, fb_post', 'safe'),
			array('id, company_id, title, detail, publish_date, date_added, date_updated, is_approved, visible, readcount, keywords, seo_title, seo_desc, slug, common_tags', 'safe', 'on'=>'search'),
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
            'article_file' => array(self::HAS_MANY, 'ArticleFile', 'article_id'),
            'article_source'=>array(self::HAS_MANY, 'ArticleSource', 'article_id'),
            'articles'=>array(self::BELONGS_TO, 'Company', 'company_id'),
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
			'title' => 'Title',
			'detail' => 'Article detail',
			'publish_date' => 'Publish Date',
			'date_added' => 'Date Added',
			'date_updated' => 'Date Updated',
			'is_approved' => 'Is Approved',
			'visible' => 'Visible',
			'readcount' => 'Readcount',
			'keywords' => 'Keywords',
			'seo_title' => 'Seo Title',
			'seo_desc' => 'Seo Desc',
			'slug' => 'Slug',
			'common_tags' => 'Common Tags',
			'comment_option' => 'Comment Option',
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
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('publish_date',$this->publish_date,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('is_approved',$this->is_approved);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('readcount',$this->readcount);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_desc',$this->seo_desc,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('common_tags',$this->common_tags,true);
		$criteria->compare('comment_option',$this->comment_option);
        $criteria->compare('editor_type',$this->editor_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    /**
    * return total article count in database
    */
    public function totalArticlesCount()
    {
        return Articles::model()->count();
    }
     
	public function findmaxnumber()
	{
		$model = new Articles;
		$criteria=new CDbCriteria;
		$criteria->select='max(id) AS maxColumn';
		$row = $model->model()->find($criteria);
		return $row['maxColumn'];
	}
    
    public function get_images_by_article_id($article_id)
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition('filename IS NOT NULL AND article_id='.$article_id.' AND file_type=1');
        return ArticleFile::model()->findAll($criteria);
    }
    
    public function Image($filename, $size='thumb', $alt='')
    {
        //echo $filename;die();
        //$alt = htmlspecialchars_decode($alt);
        $baseUrl = Yii::app()->baseUrl;
        $basePath = Yii::app()->basePath;
        if($size=='thumb1'){
            $size = 'thumb';
            $html_opt = array('width'=>60, 'height'=>60);
        }
            
        else
            $html_opt = array();
        if(file_exists($basePath.'/../images/frontend/'.$size.'/'.$filename) && $filename)
            return CHtml::image($baseUrl.'/images/frontend/'.$size.'/'.$filename, $alt, $html_opt);
        else
            return CHtml::image($baseUrl.'/images/article_fallback_80x80.png', $alt, $html_opt);    
    }
    
    public function getDocFilesize($filename)
    {
        if(file_exists(Yii::app()->basePath.'/../documents/'.$filename))
            return CommonClass::format_file_size(filesize(Yii::app()->basePath.'/../documents/'.$filename));
        else
            return false;
    }
    
    public function get1ImageFromFile($article_id)
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'filename, title';
        $criteria->addCondition('article_id='.$article_id.' AND filename!="" AND file_type=1');
        if($file= ArticleFile::model()->find($criteria))
            $f = $file->filename;
        else
            $f = "";
         return $f;           
    }

    //for article image thumb
    public function ThumbImage($filename, $size='thumb', $alt='',$companyId)
    {
        $baseUrl = Yii::app()->baseUrl;
        $basePath = Yii::app()->basePath;
        if($size=='thumb1'){
            $size = 'thumb';
            $html_opt = array('width'=>60, 'height'=>60);
        }
        else
            $html_opt = array();

        if(file_exists($basePath.'/../images/frontend/'.$size.'/'.$filename) && $filename)
            return CHtml::image($baseUrl.'/images/frontend/'.$size.'/'.$filename, $alt, $html_opt);
        else{
            if($companyId!='' && $companyId!=0){
                $companyImage = Company::companyInfo($companyId,'image')->image;
                if(file_exists($basePath.'/../images/frontend/'.$companyImage) && $companyImage)
                    return CHtml::image($baseUrl.'/images/frontend/'.$companyImage, $alt, $html_opt);
                else
                    return CHtml::image($baseUrl.'/images/frontend/thumb/article_fallback_90x90.png', $alt, $html_opt);
            }
            else
                return CHtml::image($baseUrl.'/images/frontend/thumb/article_fallback_90x90.png', $alt, $html_opt);
        }
    }
    
    public function articleInfo($article_id, $select='*')
    {
        $criteria = new CDbCriteria;
        $criteria->select=$select;
        $criteria->condition='id='.$article_id;
        return Articles::model()->find($criteria);
    }
    
	public function countArticlesOfCompany()
    {
        $criteria = new CDbCriteria;
        $criteria->select = array('name', 'slug', 'count(articles.company_id) as count');
        //$criteria->condition='articles.visible=1';
        $criteria->with=array('articles');
        $criteria->group = 'articles.company_id';
        return Company::model()->findAll($criteria); 
    }
    
     public function countArticlesByCompany($company_id)
    {
       $criteria= new CDbCriteria;
       $criteria->addCondition("is_approved=1 AND visible=1 AND publish_date<=CURDATE() AND company_id=$company_id");
       return Articles::model()->count($criteria);
    }
    
    public function get_articles_by_id($id)
    {
        return Articles::model()->findByPk($id);
    }
    
    public function getArticlesNotInNewsletter($newsletter_id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition="visible=1";
        $criteria->addNotInCondition('id',NewsletterItems::getItemsByType($newsletter_id,1));
        $criteria->order='publish_date DESC';
        $criteria->limit=20;
        return Articles::model()->findAll($criteria);
    }
    
    public function get_article_by_slug($slug)
    {
        return Articles::model()->findByAttributes(array('slug'=>$slug));
    }
    
    public function countArticlesByTags($tagId)
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition("common_tags REGEXP '({$tagId},)|{$tagId}$' AND is_approved = 1 AND visible = 1 AND publish_date<=CURDATE()");
        return Articles::model()->count($criteria);
    }
    
    //return previous news
    public function prev_article_by_slug($article_id)
    {
        //$newsId = Articles::get_news_id_by_slug($slug);
        $criteria = new CDbCriteria;
        $criteria->select = array('slug', 'title');
        $criteria->addCondition('is_approved=1 AND visible=1 AND id<'.$article_id);
        $criteria->order = 'id DESC';
        $criteria->limit = 1;
        $article = Articles::model()->find($criteria);
        if($article)
            return $article;
        else
            return false;    
    }
    
    //return next news
    public function next_article_by_slug($article_id)
    {
        $criteria = new CDbCriteria;
        $criteria->select = array('slug', 'title');
        $criteria->addCondition('is_approved=1 AND visible=1 AND id>'.$article_id);
        $criteria->order = 'id DESC';
        $criteria->limit = 1;
        $article = Articles::model()->find($criteria);
        if($article)
            return $article;
        else
            return false;;    
    }
    
     public function getLatestArticles()
     {
        $criteria = new CDbCriteria;
        $criteria->addCondition("is_approved=1 AND visible=1 AND publish_date<=CURDATE()");
        $criteria->limit = 6;
        $criteria->order = 'publish_date DESC';
        return Articles::model()->findAll($criteria);
     }
     
     public function getPendingArticle($encryptedSlug)
     {
        $criteria = new CDbCriteria;
        $criteria->addCondition("is_approved=0 AND MD5(slug)='".$encryptedSlug."'");
        return Articles::model()->find($criteria);
     }      
}