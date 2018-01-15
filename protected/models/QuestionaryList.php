<?php

/**
 * This is the model class for table "questionary_list".
 *
 * The followings are the available columns in table 'questionary_list':
 * @property string $id
 * @property string $userID
 * @property string $questionaryID
 * @property integer $isSend
 * @property integer $isSubmit
 * @property string $jsonData
 * @property string $deviceToken
 * @property integer $deviceTypeID
 */
class QuestionaryList extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'questionary_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, questionaryID, deviceToken, deviceTypeID', 'required'),
			array('isSend, isSubmit, deviceTypeID', 'numerical', 'integerOnly'=>true),
			array('id, userID, questionaryID', 'length', 'max'=>36),
			array('deviceToken', 'length', 'max'=>255),
			array('jsonData', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userID, questionaryID, isSend, isSubmit, jsonData, deviceToken, deviceTypeID', 'safe', 'on'=>'search'),
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
			'userID' => 'User',
			'questionaryID' => 'Questionary',
			'isSend' => 'Is Send',
			'isSubmit' => 'Is Submit',
			'jsonData' => 'Json Data',
			'deviceToken' => 'Device Token',
			'deviceTypeID' => 'Device Type',
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
		$criteria->compare('userID',$this->userID,true);
		$criteria->compare('questionaryID',$this->questionaryID,true);
		$criteria->compare('isSend',$this->isSend);
		$criteria->compare('isSubmit',$this->isSubmit);
		$criteria->compare('jsonData',$this->jsonData,true);
		$criteria->compare('deviceToken',$this->deviceToken,true);
		$criteria->compare('deviceTypeID',$this->deviceTypeID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return QuestionaryList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
