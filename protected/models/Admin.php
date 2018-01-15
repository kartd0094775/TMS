<?php

/**
 * This is the model class for table "admin".
 *
 * The followings are the available columns in table 'admin':
 * @property integer $id
 * @property string $account
 * @property string $password
 * @property string $nickname
 * @property string $email
 * @property string $updatedat
 * @property string $createdat
 * @property integer $roleID
 * @property string $permissionJson
 * @property string $buildingIDs
 * @property string $floorIDs
 * @property string $apiKey
 */
class Admin extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'admin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('roleID', 'numerical', 'integerOnly'=>true),
			array('account, nickname, email', 'length', 'max'=>100),
			array('password', 'length', 'max'=>32),
			array('apiKey', 'length', 'max'=>255),
			array('updatedat, createdat, permissionJson, buildingIDs, floorIDs', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, account, password, nickname, email, updatedat, createdat, roleID, permissionJson, buildingIDs, floorIDs, apiKey', 'safe', 'on'=>'search'),
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
			'account' => 'Account',
			'password' => 'Password',
			'nickname' => 'Nickname',
			'email' => 'Email',
			'updatedat' => 'Updatedat',
			'createdat' => 'Createdat',
			'roleID' => 'Role',
			'permissionJson' => 'Permission Json',
			'buildingIDs' => 'Building Ids',
			'floorIDs' => 'Floor Ids',
			'apiKey' => 'Api Key',
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
		$criteria->compare('account',$this->account,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('updatedat',$this->updatedat,true);
		$criteria->compare('createdat',$this->createdat,true);
		$criteria->compare('roleID',$this->roleID);
		$criteria->compare('permissionJson',$this->permissionJson,true);
		$criteria->compare('buildingIDs',$this->buildingIDs,true);
		$criteria->compare('floorIDs',$this->floorIDs,true);
		$criteria->compare('apiKey',$this->apiKey,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Admin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
