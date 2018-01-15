<?php

/**
 * This is the model class for table "producer_s".
 *
 * The followings are the available columns in table 'producer_s':
 * @property string $id
 * @property integer $status
 * @property integer $isSticky
 * @property string $account
 * @property string $password
 * @property string $name
 * @property string $nickname
 * @property integer $mainType
 * @property integer $subType
 * @property string $priceRange
 * @property string $area
 * @property string $address
 * @property string $tel
 * @property string $photo
 * @property string $photos
 * @property string $vacation
 * @property string $website
 * @property string $description
 * @property string $onsaleInformation
 * @property string $rightsInformation
 * @property string $beacon
 * @property string $beaconIds
 * @property string $openTimeWorkday
 * @property string $openTimeVacation
 * @property integer $countClick
 * @property integer $countFavor
 * @property double $lat
 * @property double $lon
 * @property integer $isAdmin
 * @property string $updatedat
 * @property string $createdat
 */
class ProducerS extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'producer_s';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, status, isSticky, account, password, name, nickname, mainType, subType, priceRange, area, address, tel, photo, photos, vacation, website, description, onsaleInformation, rightsInformation, beacon, beaconIds, openTimeWorkday, openTimeVacation, countClick, countFavor, lat, lon, isAdmin, updatedat, createdat', 'required'),
			array('status, isSticky, mainType, subType, countClick, countFavor, isAdmin', 'numerical', 'integerOnly'=>true),
			array('lat, lon', 'numerical'),
			array('id', 'length', 'max'=>36),
			array('account, name, nickname, priceRange, area, address, tel, vacation, website, openTimeWorkday, openTimeVacation', 'length', 'max'=>255),
			array('password', 'length', 'max'=>32),
			array('photo', 'length', 'max'=>1024),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, status, isSticky, account, password, name, nickname, mainType, subType, priceRange, area, address, tel, photo, photos, vacation, website, description, onsaleInformation, rightsInformation, beacon, beaconIds, openTimeWorkday, openTimeVacation, countClick, countFavor, lat, lon, isAdmin, updatedat, createdat', 'safe', 'on'=>'search'),
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
			'status' => 'Status',
			'isSticky' => 'Is Sticky',
			'account' => 'Account',
			'password' => 'Password',
			'name' => 'Name',
			'nickname' => 'Nickname',
			'mainType' => 'Main Type',
			'subType' => 'Sub Type',
			'priceRange' => 'Price Range',
			'area' => 'Area',
			'address' => 'Address',
			'tel' => 'Tel',
			'photo' => 'Photo',
			'photos' => 'Photos',
			'vacation' => 'Vacation',
			'website' => 'Website',
			'description' => 'Description',
			'onsaleInformation' => 'Onsale Information',
			'rightsInformation' => 'Rights Information',
			'beacon' => 'Beacon',
			'beaconIds' => 'Beacon Ids',
			'openTimeWorkday' => 'Open Time Workday',
			'openTimeVacation' => 'Open Time Vacation',
			'countClick' => 'Count Click',
			'countFavor' => 'Count Favor',
			'lat' => 'Lat',
			'lon' => 'Lon',
			'isAdmin' => 'Is Admin',
			'updatedat' => 'Updatedat',
			'createdat' => 'Createdat',
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
		$criteria->compare('status',$this->status);
		$criteria->compare('isSticky',$this->isSticky);
		$criteria->compare('account',$this->account,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('mainType',$this->mainType);
		$criteria->compare('subType',$this->subType);
		$criteria->compare('priceRange',$this->priceRange,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('photos',$this->photos,true);
		$criteria->compare('vacation',$this->vacation,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('onsaleInformation',$this->onsaleInformation,true);
		$criteria->compare('rightsInformation',$this->rightsInformation,true);
		$criteria->compare('beacon',$this->beacon,true);
		$criteria->compare('beaconIds',$this->beaconIds,true);
		$criteria->compare('openTimeWorkday',$this->openTimeWorkday,true);
		$criteria->compare('openTimeVacation',$this->openTimeVacation,true);
		$criteria->compare('countClick',$this->countClick);
		$criteria->compare('countFavor',$this->countFavor);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('lon',$this->lon);
		$criteria->compare('isAdmin',$this->isAdmin);
		$criteria->compare('updatedat',$this->updatedat,true);
		$criteria->compare('createdat',$this->createdat,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProducerS the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
