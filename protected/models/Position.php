<?php

/**
 * This is the model class for table "position".
 *
 * The followings are the available columns in table 'position':
 * @property integer $id
 * @property string $deviceID
 * @property string $ts
 * @property string $buildingCode
 * @property integer $navEnable
 * @property string $gpsLat
 * @property string $gpsLng
 * @property string $gpsAcc
 * @property string $locX
 * @property string $locY
 * @property string $locZ
 * @property string $locAcc
 * @property string $ip
 * @property string $createTime
 */
class Position extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'position';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('navEnable', 'numerical', 'integerOnly'=>true),
			array('deviceID, ts, buildingCode, gpsLat, gpsLng, gpsAcc, locX, locY, locZ, locAcc', 'length', 'max'=>255),
			array('ip', 'length', 'max'=>20),
			array('createTime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, deviceID, ts, buildingCode, navEnable, gpsLat, gpsLng, gpsAcc, locX, locY, locZ, locAcc, ip, createTime', 'safe', 'on'=>'search'),
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
			'buildingCode' => 'Building Code',
			'navEnable' => 'Nav Enable',
			'gpsLat' => 'Gps Lat',
			'gpsLng' => 'Gps Lng',
			'gpsAcc' => 'Gps Acc',
			'locX' => 'Loc X',
			'locY' => 'Loc Y',
			'locZ' => 'Loc Z',
			'locAcc' => 'Loc Acc',
			'ip' => 'Ip',
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
		$criteria->compare('buildingCode',$this->buildingCode,true);
		$criteria->compare('navEnable',$this->navEnable);
		$criteria->compare('gpsLat',$this->gpsLat,true);
		$criteria->compare('gpsLng',$this->gpsLng,true);
		$criteria->compare('gpsAcc',$this->gpsAcc,true);
		$criteria->compare('locX',$this->locX,true);
		$criteria->compare('locY',$this->locY,true);
		$criteria->compare('locZ',$this->locZ,true);
		$criteria->compare('locAcc',$this->locAcc,true);
		$criteria->compare('ip',$this->ip,true);
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
	 * @return Position the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
