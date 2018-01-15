<?php

/**
 * This is the model class for table "position2".
 *
 * The followings are the available columns in table 'position2':
 * @property integer $id
 * @property string $deviceID
 * @property string $ts
 * @property string $gpsLat
 * @property string $gpsLng
 * @property string $gpsAcc
 * @property string $dataJson
 * @property string $createTime
 */
class Position2 extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'position2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('deviceID, ts, gpsLat, gpsLng, gpsAcc, createTime', 'required'),
			array('deviceID, ts, gpsLat, gpsLng, gpsAcc', 'length', 'max'=>255),
			array('dataJson', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, deviceID, ts, gpsLat, gpsLng, gpsAcc, dataJson, createTime', 'safe', 'on'=>'search'),
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
			'deviceID' => 'Device',
			'ts' => 'Ts',
			'gpsLat' => 'Gps Lat',
			'gpsLng' => 'Gps Lng',
			'gpsAcc' => 'Gps Acc',
			'dataJson' => 'Data Json',
			'createTime' => 'Create Time',
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
		$criteria->compare('deviceID',$this->deviceID,true);
		$criteria->compare('ts',$this->ts,true);
		$criteria->compare('gpsLat',$this->gpsLat,true);
		$criteria->compare('gpsLng',$this->gpsLng,true);
		$criteria->compare('gpsAcc',$this->gpsAcc,true);
		$criteria->compare('dataJson',$this->dataJson,true);
		$criteria->compare('createTime',$this->createTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbSto;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Position2 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
