<?php

/**
 * This is the model class for table "user_event".
 *
 * The followings are the available columns in table 'user_event':
 * @property string $code
 * @property string $userId
 * @property string $eventId
 * @property integer $status
 * @property integer $isWinner
 * @property string $joinedAt
 * @property string $drewAt
 */
class UserEvent extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, userId, eventId, status, isWinner, joinedAt, drewAt', 'required'),
			array('status, isWinner', 'numerical', 'integerOnly'=>true),
			array('code, userId, eventId', 'length', 'max'=>36),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('code, userId, eventId, status, isWinner, joinedAt, drewAt', 'safe', 'on'=>'search'),
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
			'code' => 'Code',
			'userId' => 'User',
			'eventId' => 'Event',
			'status' => 'Status',
			'isWinner' => 'Is Winner',
			'joinedAt' => 'Joined At',
			'drewAt' => 'Drew At',
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

		$criteria->compare('code',$this->code,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('eventId',$this->eventId,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('isWinner',$this->isWinner);
		$criteria->compare('joinedAt',$this->joinedAt,true);
		$criteria->compare('drewAt',$this->drewAt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserEvent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
