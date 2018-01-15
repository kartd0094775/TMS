<?php

/**
 * This is the model class for table "floor_roi".
 *
 * The followings are the available columns in table 'floor_roi':
 * @property integer $id
 * @property integer $buildingID
 * @property integer $floorID
 * @property string $name
 * @property string $x
 * @property string $y
 * @property string $createTime
 * @property string $photo
 * @property string $photoJson
 * @property double $radius
 * @property string $message
 */
class FloorRoi extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'floor_roi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('buildingID, floorID', 'required'),
			array('buildingID, floorID', 'numerical', 'integerOnly'=>true),
			array('radius', 'numerical'),
			array('name, x, y, photo', 'length', 'max'=>255),
			array('createTime, photoJson, message', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, buildingID, floorID, name, x, y, createTime, photo, photoJson, radius, message', 'safe', 'on'=>'search'),
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
			'buildingID' => 'Building',
			'floorID' => 'Floor',
			'name' => 'Name',
			'x' => 'X',
			'y' => 'Y',
			'createTime' => 'Create Time',
			'photo' => 'Photo',
			'photoJson' => 'Photo Json',
			'radius' => 'Radius',
			'message' => 'Message',
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
		$criteria->compare('buildingID',$this->buildingID);
		$criteria->compare('floorID',$this->floorID);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('x',$this->x,true);
		$criteria->compare('y',$this->y,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('photoJson',$this->photoJson,true);
		$criteria->compare('radius',$this->radius);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FloorRoi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
