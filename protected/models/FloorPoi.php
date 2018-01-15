<?php

/**
 * This is the model class for table "floor_poi".
 *
 * The followings are the available columns in table 'floor_poi':
 * @property integer $id
 * @property integer $floorID
 * @property string $name
 * @property string $x
 * @property string $y
 * @property string $createTime
 * @property string $photo
 * @property string $photoJson
 * @property integer $buildingID
 * @property integer $iconID
 * @property string $lat
 * @property string $lng
 * @property integer $priority
 * @property integer $publicFacilityID
 * @property integer $vendorID
 * @property string $number
 * @property string $nameEnglish
 * @property string $content
 * @property integer $priorityFrom
 * @property integer $priorityTo
 * @property string $url
 * @property string $photo360
 * @property string $updateTime
 * @property string $contentEnglish
 */
class FloorPoi extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'floor_poi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('floorID, buildingID', 'required'),
			array('poiID, floorID, buildingID, iconID, priority, publicFacilityID, vendorID, priorityFrom, priorityTo', 'numerical', 'integerOnly'=>true),
			array('name, x, y, photo, lat, lng, number, nameEnglish, photo360', 'length', 'max'=>255),
			array('createTime, photoJson, content, url, updateTime, contentEnglish', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, poiID, floorID, name, x, y, createTime, photo, photoJson, buildingID, iconID, lat, lng, priority, publicFacilityID, vendorID, number, nameEnglish, content, priorityFrom, priorityTo, url, photo360, updateTime, contentEnglish', 'safe', 'on'=>'search'),
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
                        'poiID' => 'POI',
                        'floorID' => 'Floor',
			'name' => 'Name',
			'x' => 'X',
			'y' => 'Y',
			'createTime' => 'Create Time',
			'photo' => 'Photo',
			'photoJson' => 'Photo Json',
			'buildingID' => 'Building',
			'iconID' => 'Icon',
			'lat' => 'Lat',
			'lng' => 'Lng',
			'priority' => 'Priority',
			'publicFacilityID' => 'Public Facility',
			'vendorID' => 'Vendor',
			'number' => 'Number',
			'nameEnglish' => 'Name English',
			'content' => 'Content',
			'priorityFrom' => 'Priority From',
			'priorityTo' => 'Priority To',
			'url' => 'Url',
			'photo360' => 'Photo360',
			'updateTime' => 'Update Time',
			'contentEnglish' => 'Content English',
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
                $criteria->compare('poiID', $this->poiID);
                $criteria->compare('floorID',$this->floorID);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('x',$this->x,true);
		$criteria->compare('y',$this->y,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('photoJson',$this->photoJson,true);
		$criteria->compare('buildingID',$this->buildingID);
		$criteria->compare('iconID',$this->iconID);
		$criteria->compare('lat',$this->lat,true);
		$criteria->compare('lng',$this->lng,true);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('publicFacilityID',$this->publicFacilityID);
		$criteria->compare('vendorID',$this->vendorID);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('nameEnglish',$this->nameEnglish,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('priorityFrom',$this->priorityFrom);
		$criteria->compare('priorityTo',$this->priorityTo);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('photo360',$this->photo360,true);
		$criteria->compare('updateTime',$this->updateTime,true);
		$criteria->compare('contentEnglish',$this->contentEnglish,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FloorPoi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
