<?php

/**
 * This is the model class for table "building".
 *
 * The followings are the available columns in table 'building':
 * @property integer $id
 * @property integer $companyID
 * @property string $name
 * @property string $createTime
 * @property string $zip
 * @property string $code
 * @property string $lastVersion
 * @property string $lastVersionCode
 * @property string $txt
 * @property integer $cityID
 * @property string $photo
 * @property string $photoJson
 * @property string $API_Building_01
 * @property string $API_Building_02
 * @property string $API_Building_03
 * @property double $sequence
 * @property integer $isActive
 * @property string $dataID
 * @property string $AREA
 * @property string $address
 * @property string $TYPE
 * @property string $SUMMARY
 * @property string $TEL
 * @property string $PAYEX
 * @property string $SERVICETIME
 * @property string $TW97X
 * @property string $TW97Y
 * @property string $TOTALCAR
 * @property string $TOTALMOTOR
 * @property string $TOTALBIKE
 * @property double $AVAILABLECAR
 * @property string $API_Building_04
 * @property string $API_Building_05
 * @property integer $isPublic
 */
class Building extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'building';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createTime, code', 'required'),
			array('companyID, cityID, isActive, isPublic', 'numerical', 'integerOnly'=>true),
			array('sequence, AVAILABLECAR', 'numerical'),
			array('name, zip, code, lastVersion, lastVersionCode, txt, photo, dataID, AREA, address, TYPE, SUMMARY, TEL, PAYEX, SERVICETIME, TW97X, TW97Y, TOTALCAR, TOTALMOTOR, TOTALBIKE', 'length', 'max'=>255),
			array('photoJson, API_Building_01, API_Building_02, API_Building_03, API_Building_04, API_Building_05', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, companyID, name, createTime, zip, code, lastVersion, lastVersionCode, txt, cityID, photo, photoJson, API_Building_01, API_Building_02, API_Building_03, sequence, isActive, dataID, AREA, address, TYPE, SUMMARY, TEL, PAYEX, SERVICETIME, TW97X, TW97Y, TOTALCAR, TOTALMOTOR, TOTALBIKE, AVAILABLECAR, API_Building_04, API_Building_05, isPublic', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'createTime' => 'Create Time',
			'zip' => 'Zip',
			'code' => 'Code',
			'lastVersion' => 'Last Version',
			'lastVersionCode' => 'Last Version Code',
			'txt' => 'Txt',
			'cityID' => 'City',
			'photo' => 'Photo',
			'photoJson' => 'Photo Json',
			'API_Building_01' => 'Api Building 01',
			'API_Building_02' => 'Api Building 02',
			'API_Building_03' => 'Api Building 03',
			'sequence' => 'Sequence',
			'isActive' => 'Is Active',
			'dataID' => 'Data',
			'AREA' => 'Area',
			'address' => 'Address',
			'TYPE' => 'Type',
			'SUMMARY' => 'Summary',
			'TEL' => 'Tel',
			'PAYEX' => 'Payex',
			'SERVICETIME' => 'Servicetime',
			'TW97X' => 'Tw97 X',
			'TW97Y' => 'Tw97 Y',
			'TOTALCAR' => 'Totalcar',
			'TOTALMOTOR' => 'Totalmotor',
			'TOTALBIKE' => 'Totalbike',
			'AVAILABLECAR' => 'Availablecar',
			'API_Building_04' => 'Api Building 04',
			'API_Building_05' => 'Api Building 05',
			'isPublic' => 'Is Public',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('zip',$this->zip,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('lastVersion',$this->lastVersion,true);
		$criteria->compare('lastVersionCode',$this->lastVersionCode,true);
		$criteria->compare('txt',$this->txt,true);
		$criteria->compare('cityID',$this->cityID);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('photoJson',$this->photoJson,true);
		$criteria->compare('API_Building_01',$this->API_Building_01,true);
		$criteria->compare('API_Building_02',$this->API_Building_02,true);
		$criteria->compare('API_Building_03',$this->API_Building_03,true);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('isActive',$this->isActive);
		$criteria->compare('dataID',$this->dataID,true);
		$criteria->compare('AREA',$this->AREA,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('TYPE',$this->TYPE,true);
		$criteria->compare('SUMMARY',$this->SUMMARY,true);
		$criteria->compare('TEL',$this->TEL,true);
		$criteria->compare('PAYEX',$this->PAYEX,true);
		$criteria->compare('SERVICETIME',$this->SERVICETIME,true);
		$criteria->compare('TW97X',$this->TW97X,true);
		$criteria->compare('TW97Y',$this->TW97Y,true);
		$criteria->compare('TOTALCAR',$this->TOTALCAR,true);
		$criteria->compare('TOTALMOTOR',$this->TOTALMOTOR,true);
		$criteria->compare('TOTALBIKE',$this->TOTALBIKE,true);
		$criteria->compare('AVAILABLECAR',$this->AVAILABLECAR);
		$criteria->compare('API_Building_04',$this->API_Building_04,true);
		$criteria->compare('API_Building_05',$this->API_Building_05,true);
		$criteria->compare('isPublic',$this->isPublic);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Building the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
