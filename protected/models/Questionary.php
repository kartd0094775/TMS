<?php

/**
 * This is the model class for table "questionary".
 *
 * The followings are the available columns in table 'questionary':
 * @property string $id
 * @property string $name
 * @property string $createTime
 * @property string $dateFrom
 * @property string $dateTo
 * @property string $jsonData
 */
class Questionary extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'questionary';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, name, createTime', 'required'),
			array('id', 'length', 'max'=>36),
			array('name', 'length', 'max'=>255),
			array('dateFrom, dateTo, jsonData', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, createTime, dateFrom, dateTo, jsonData', 'safe', 'on'=>'search'),
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
			'createTime' => 'Create Time',
			'dateFrom' => 'Date From',
			'dateTo' => 'Date To',
			'jsonData' => 'Json Data',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('dateFrom',$this->dateFrom,true);
		$criteria->compare('dateTo',$this->dateTo,true);
		$criteria->compare('jsonData',$this->jsonData,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Questionary the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
