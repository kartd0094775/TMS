<?php

/**
 * This is the model class for table "producer_url".
 *
 * The followings are the available columns in table 'producer_url':
 * @property integer $id
 * @property string $producerID
 * @property string $url
 * @property double $sequence
 * @property string $createTime
 * @property integer $typeID
 * @property string $jsonData
 */
class ProducerUrl extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'producer_url';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('producerID, url, createTime', 'required'),
			array('typeID', 'numerical', 'integerOnly'=>true),
			array('sequence', 'numerical'),
			array('producerID', 'length', 'max'=>255),
			array('jsonData', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, producerID, url, sequence, createTime, typeID, jsonData', 'safe', 'on'=>'search'),
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
			'producerID' => 'Producer',
			'url' => 'Url',
			'sequence' => 'Sequence',
			'createTime' => 'Create Time',
			'typeID' => 'Type',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('producerID',$this->producerID,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('typeID',$this->typeID);
		$criteria->compare('jsonData',$this->jsonData,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProducerUrl the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
