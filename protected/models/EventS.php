<?php

/**
 * This is the model class for table "event_s".
 *
 * The followings are the available columns in table 'event_s':
 * @property string $id
 * @property integer $status
 * @property string $producerId
 * @property integer $mainType
 * @property integer $subType
 * @property string $area
 * @property string $start
 * @property string $end
 * @property string $photo
 * @property string $name
 * @property string $brief
 * @property string $description
 * @property integer $total
 * @property string $lotteryInitAt
 * @property string $lotteryRunAt
 * @property integer $lotteryAmount
 * @property string $lotteryAddress
 * @property string $lotteryResult
 * @property integer $frequency
 * @property integer $countClick
 * @property integer $countFavor
 * @property integer $countJoined
 * @property string $approvedAt
 * @property string $updatedat
 * @property string $createdat
 */
class EventS extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'event_s';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, status, producerId, mainType, subType, area, start, end, photo, name, brief, description, total, lotteryInitAt, lotteryRunAt, lotteryAmount, lotteryAddress, lotteryResult, frequency, countClick, countFavor, countJoined, approvedAt, updatedat, createdat', 'required'),
			array('status, mainType, subType, total, lotteryAmount, frequency, countClick, countFavor, countJoined', 'numerical', 'integerOnly'=>true),
			array('id, producerId', 'length', 'max'=>36),
			array('area, name', 'length', 'max'=>255),
			array('photo', 'length', 'max'=>1024),
			array('lotteryAddress', 'length', 'max'=>512),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, status, producerId, mainType, subType, area, start, end, photo, name, brief, description, total, lotteryInitAt, lotteryRunAt, lotteryAmount, lotteryAddress, lotteryResult, frequency, countClick, countFavor, countJoined, approvedAt, updatedat, createdat', 'safe', 'on'=>'search'),
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
			'producerId' => 'Producer',
			'mainType' => 'Main Type',
			'subType' => 'Sub Type',
			'area' => 'Area',
			'start' => 'Start',
			'end' => 'End',
			'photo' => 'Photo',
			'name' => 'Name',
			'brief' => 'Brief',
			'description' => 'Description',
			'total' => 'Total',
			'lotteryInitAt' => 'Lottery Init At',
			'lotteryRunAt' => 'Lottery Run At',
			'lotteryAmount' => 'Lottery Amount',
			'lotteryAddress' => 'Lottery Address',
			'lotteryResult' => 'Lottery Result',
			'frequency' => 'Frequency',
			'countClick' => 'Count Click',
			'countFavor' => 'Count Favor',
			'countJoined' => 'Count Joined',
			'approvedAt' => 'Approved At',
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
		$criteria->compare('producerId',$this->producerId,true);
		$criteria->compare('mainType',$this->mainType);
		$criteria->compare('subType',$this->subType);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('brief',$this->brief,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('lotteryInitAt',$this->lotteryInitAt,true);
		$criteria->compare('lotteryRunAt',$this->lotteryRunAt,true);
		$criteria->compare('lotteryAmount',$this->lotteryAmount);
		$criteria->compare('lotteryAddress',$this->lotteryAddress,true);
		$criteria->compare('lotteryResult',$this->lotteryResult,true);
		$criteria->compare('frequency',$this->frequency);
		$criteria->compare('countClick',$this->countClick);
		$criteria->compare('countFavor',$this->countFavor);
		$criteria->compare('countJoined',$this->countJoined);
		$criteria->compare('approvedAt',$this->approvedAt,true);
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
	 * @return EventS the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
