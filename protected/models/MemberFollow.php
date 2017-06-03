<?php

/**
 * This is the model class for table "admin_email".
 *
 * The followings are the available columns in table 'admin_email':
 * @property integer $id
 * @property string $email1
 * @property string $email2
 * @property string $email3
 * @property string $email4
 * @property string $email5
 * @property integer $status
 */
class MemberFollow extends CActiveRecord
{
   
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
		return 'tbl_members_follow';
	}
    public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('name, contact_person, number, email, password, password_real, fax, website, twitter, facebok, pinterest, google, tagline, detail, logo, display_address, street_add, suburb, province, latitude, longitude, status, slug, date_added, date_updated, seo_title, seo_desc, seo_keywords', 'required'),
            array('member_id,follower_id','required','on'=>'create'),
         
		);
	}
    
    public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'value' => 'Value',
            'client_id' =>'Client Id'
		);
	}
    
    public function recent( $limit = 2 ) {

    $this->getDbCriteria()->mergeWith(array(
        //'order' => $this->getTableAlias(false, false).'.createTime DESC',
        'limit' => (int) $limit,
    ));

    return $this;
    }
    
    public function load_more($limit,$offset)
    {
        $criteria = new CDbCriteria;
        $criteria->select = array('id, fname');
        $criteria->order = 'fname asc';
        $company = Company::model()->findAll($criteria);
        return $company;
    }
    
    public function isfollowed($follower_id,$member_id)
    {
        if(self::model()->findByAttributes(['follower_id'=>$follower_id,'member_id'=>$member_id]))
            return true;
        else
            return false;
    }
    
    public function totalMember($cid)
    {
        $count = self::model()->countByAttributes (['follower_id'=>$cid]);
        return $count;
        
    }

 }