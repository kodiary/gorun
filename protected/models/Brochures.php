<?php

/**
 * This is the model class for table "tbl_brochures".
 *
 * The followings are the available columns in table 'tbl_brochures':
 * @property integer $id
 * @property integer $company_id
 * @property string $title
 * @property string $detail
 * @property string $date_updated
 * @property string $filename
 * @property integer $display_order
 * @property string $editor_type
 */
class Brochures extends CActiveRecord
{
    public $basic_editor;
    public $maxOrder;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Brochures the static model class
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
		return 'tbl_brochures';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, detail', 'required'),
			array('company_id, display_order', 'numerical', 'integerOnly'=>true),
			array('title, filename', 'length', 'max'=>255),
			array('filename,date_updated,display_order,editor_type', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, title, detail, date_updated, filename, display_order', 'safe', 'on'=>'search'),
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
			'title' => 'Brochure title',
			'detail' => 'Brochure Info',
			'date_updated' => 'Date Updated',
			'filename' => 'Filename',
			'display_order' => 'Display Order',
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
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('display_order',$this->display_order);
        $criteria->compare('editor_type',$this->editor_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    # return  the max display order value
    public function maxDisplayVal($companyId)
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'max(display_order) AS maxOrder';
        $criteria->condition = 'company_id='.$companyId;
        $row = $this->find($criteria);
        $displayOrder = $row['maxOrder']+1;
        return $displayOrder;
    }
}