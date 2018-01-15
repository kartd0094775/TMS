<?php

/**
 * This is the model class for table "banner2".
 *
 * The followings are the available columns in table 'banner2':
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $photo
 * @property integer $isActive
 * @property string $createTime
 * @property string $photoJson
 */
class Banner2 extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'banner2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('isActive, createTime', 'required'),
			array('isActive', 'numerical', 'integerOnly'=>true),
			array('name, photo', 'length', 'max'=>255),
			array('url, photoJson', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, url, photo, isActive, createTime, photoJson', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'url' => 'Url',
			'photo' => 'Photo',
			'isActive' => 'Is Active',
			'createTime' => 'Create Time',
			'photoJson' => 'Photo Json',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('isActive',$this->isActive);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('photoJson',$this->photoJson,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Banner2 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
