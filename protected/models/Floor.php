<?php

/**
 * This is the model class for table "floor".
 *
 * The followings are the available columns in table 'floor':
 * @property integer $id
 * @property integer $companyID
 * @property integer $buildingID
 * @property string $name
 * @property string $createTime
 * @property string $floor
 * @property string $offsetX
 * @property string $offsetY
 * @property string $json
 * @property string $photo
 * @property string $mapLeftTopX
 * @property string $mapLeftTopY
 * @property string $mapRightBottomX
 * @property string $mapRightBottomY
 * @property string $mapCenterX
 * @property string $mapCenterY
 * @property double $ratio
 * @property double $mapMax
 * @property double $mapMin
 * @property integer $isUseValue
 * @property string $svg
 * @property string $fileFinger1
 * @property string $fileFinger2
 * @property string $fileFinger3
 * @property integer $cityID
 */
class Floor extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'floor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createTime', 'required'),
			array('companyID, buildingID, isUseValue, cityID', 'numerical', 'integerOnly'=>true),
			array('ratio, mapMax, mapMin', 'numerical'),
			array('name, floor, json, photo, svg, fileFinger1, fileFinger2, fileFinger3', 'length', 'max'=>255),
			array('offsetX, offsetY, mapLeftTopX, mapLeftTopY, mapRightBottomX, mapRightBottomY, mapCenterX, mapCenterY', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, companyID, buildingID, name, createTime, floor, offsetX, offsetY, json, photo, mapLeftTopX, mapLeftTopY, mapRightBottomX, mapRightBottomY, mapCenterX, mapCenterY, ratio, mapMax, mapMin, isUseValue, svg, fileFinger1, fileFinger2, fileFinger3, cityID', 'safe', 'on'=>'search'),
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
			'companyID' => 'Company',
			'buildingID' => 'Building',
			'name' => 'Name',
			'createTime' => 'Create Time',
			'floor' => 'Floor',
			'offsetX' => 'Offset X',
			'offsetY' => 'Offset Y',
			'json' => 'Json',
			'photo' => 'Photo',
			'mapLeftTopX' => 'Map Left Top X',
			'mapLeftTopY' => 'Map Left Top Y',
			'mapRightBottomX' => 'Map Right Bottom X',
			'mapRightBottomY' => 'Map Right Bottom Y',
			'mapCenterX' => 'Map Center X',
			'mapCenterY' => 'Map Center Y',
			'ratio' => 'Ratio',
			'mapMax' => 'Map Max',
			'mapMin' => 'Map Min',
			'isUseValue' => 'Is Use Value',
			'svg' => 'Svg',
			'fileFinger1' => 'File Finger1',
			'fileFinger2' => 'File Finger2',
			'fileFinger3' => 'File Finger3',
			'cityID' => 'City',
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
		$criteria->compare('companyID',$this->companyID);
		$criteria->compare('buildingID',$this->buildingID);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('floor',$this->floor,true);
		$criteria->compare('offsetX',$this->offsetX,true);
		$criteria->compare('offsetY',$this->offsetY,true);
		$criteria->compare('json',$this->json,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('mapLeftTopX',$this->mapLeftTopX,true);
		$criteria->compare('mapLeftTopY',$this->mapLeftTopY,true);
		$criteria->compare('mapRightBottomX',$this->mapRightBottomX,true);
		$criteria->compare('mapRightBottomY',$this->mapRightBottomY,true);
		$criteria->compare('mapCenterX',$this->mapCenterX,true);
		$criteria->compare('mapCenterY',$this->mapCenterY,true);
		$criteria->compare('ratio',$this->ratio);
		$criteria->compare('mapMax',$this->mapMax);
		$criteria->compare('mapMin',$this->mapMin);
		$criteria->compare('isUseValue',$this->isUseValue);
		$criteria->compare('svg',$this->svg,true);
		$criteria->compare('fileFinger1',$this->fileFinger1,true);
		$criteria->compare('fileFinger2',$this->fileFinger2,true);
		$criteria->compare('fileFinger3',$this->fileFinger3,true);
		$criteria->compare('cityID',$this->cityID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Floor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
