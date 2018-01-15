<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property integer $status
 * @property string $account
 * @property string $password
 * @property string $nickname
 * @property string $name
 * @property string $email
 * @property string $photo
 * @property integer $point
 * @property string $favor
 * @property integer $enablePush
 * @property string $updatedat
 * @property string $createdat
 */
class User extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, status, account, password, nickname, name, email, photo, point, favor, updatedat, createdat', 'required'),
			array('status, point, enablePush', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>36),
			array('account, nickname', 'length', 'max'=>100),
			array('password', 'length', 'max'=>32),
			array('name, email', 'length', 'max'=>255),
			array('photo', 'length', 'max'=>1024),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, status, account, password, nickname, name, email, photo, point, favor, enablePush, updatedat, createdat', 'safe', 'on'=>'search'),
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
			'account' => 'Account',
			'password' => 'Password',
			'nickname' => 'Nickname',
			'name' => 'Name',
			'email' => 'Email',
			'photo' => 'Photo',
			'point' => 'Point',
			'favor' => 'Favor',
			'enablePush' => 'Enable Push',
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
		$criteria->compare('account',$this->account,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('point',$this->point);
		$criteria->compare('favor',$this->favor,true);
		$criteria->compare('enablePush',$this->enablePush);
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
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
