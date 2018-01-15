<?php

/**
 * This is the model class for table "device".
 *
 * The followings are the available columns in table 'device':
 * @property string $id
 * @property integer $type
 * @property string $token
 * @property string $consumerToken
 * @property string $producerToken
 * @property string $consumerId
 * @property string $producerId
 * @property string $updatedat
 * @property string $createdat
 */
class Device extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'device';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('id, token', 'length', 'max'=>255),
			array('consumerToken, producerToken', 'length', 'max'=>512),
			array('consumerId, producerId', 'length', 'max'=>36),
			array('updatedat, createdat', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, token, consumerToken, producerToken, consumerId, producerId, updatedat, createdat', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'token' => 'Token',
			'consumerToken' => 'Consumer Token',
			'producerToken' => 'Producer Token',
			'consumerId' => 'Consumer',
			'producerId' => 'Producer',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('consumerToken',$this->consumerToken,true);
		$criteria->compare('producerToken',$this->producerToken,true);
		$criteria->compare('consumerId',$this->consumerId,true);
		$criteria->compare('producerId',$this->producerId,true);
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
	 * @return Device the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
