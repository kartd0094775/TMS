<?php

/**
 * This is the model class for table "car_license".
 *
 * The followings are the available columns in table 'car_license':
 * @property integer $id
 * @property string $carLicense
 * @property integer $ip
 * @property string $createTime
 * @property string $deviceID
 * @property integer $deveiceTypeID
 */
class CarLicense extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'car_license';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip, deveiceTypeID', 'numerical', 'integerOnly'=>true),
			array('carLicense, deviceID', 'length', 'max'=>255),
			array('createTime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, carLicense, ip, createTime, deviceID, deveiceTypeID', 'safe', 'on'=>'search'),
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
			'carLicense' => 'Car License',
			'ip' => 'Ip',
			'createTime' => 'Create Time',
			'deviceID' => 'Device',
			'deveiceTypeID' => 'Deveice Type',
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
		$criteria->compare('carLicense',$this->carLicense,true);
		$criteria->compare('ip',$this->ip);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('deviceID',$this->deviceID,true);
		$criteria->compare('deveiceTypeID',$this->deveiceTypeID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CarLicense the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
