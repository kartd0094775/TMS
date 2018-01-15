<?php

/**
 * This is the model class for table "floor_alert".
 *
 * The followings are the available columns in table 'floor_alert':
 * @property integer $id
 * @property integer $floorID
 * @property double $x
 * @property double $y
 * @property string $createTime
 * @property string $ip
 * @property string $deviceID
 */
class FloorAlert extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'floor_alert';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('floorID', 'required'),
			array('floorID', 'numerical', 'integerOnly'=>true),
			array('x, y', 'numerical'),
			array('ip', 'length', 'max'=>50),
			array('deviceID', 'length', 'max'=>255),
			array('createTime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, floorID, x, y, createTime, ip, deviceID', 'safe', 'on'=>'search'),
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
			'floorID' => 'Floor',
			'x' => 'X',
			'y' => 'Y',
			'createTime' => 'Create Time',
			'ip' => 'Ip',
			'deviceID' => 'Device',
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
		$criteria->compare('floorID',$this->floorID);
		$criteria->compare('x',$this->x);
		$criteria->compare('y',$this->y);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('deviceID',$this->deviceID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FloorAlert the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
