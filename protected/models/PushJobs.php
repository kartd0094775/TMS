<?php

/**
 * This is the model class for table "push_jobs".
 *
 * The followings are the available columns in table 'push_jobs':
 * @property string $id
 * @property integer $status
 * @property integer $loginType
 * @property string $creator
 * @property string $start
 * @property integer $spend
 * @property string $finishedat
 * @property integer $total
 * @property string $target
 * @property integer $type
 * @property string $subject
 * @property string $meta
 * @property string $updatedat
 * @property string $createdat
 */
class PushJobs extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'push_jobs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, loginType, creator, start, spend, finishedat, total, target, type, subject, meta, updatedat, createdat', 'required'),
			array('status, loginType, spend, total, type', 'numerical', 'integerOnly'=>true),
			array('creator', 'length', 'max'=>36),
			array('subject', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, status, loginType, creator, start, spend, finishedat, total, target, type, subject, meta, updatedat, createdat', 'safe', 'on'=>'search'),
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
			'loginType' => 'Login Type',
			'creator' => 'Creator',
			'start' => 'Start',
			'spend' => 'Spend',
			'finishedat' => 'Finishedat',
			'total' => 'Total',
			'target' => 'Target',
			'type' => 'Type',
			'subject' => 'Subject',
			'meta' => 'Meta',
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
		$criteria->compare('loginType',$this->loginType);
		$criteria->compare('creator',$this->creator,true);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('spend',$this->spend);
		$criteria->compare('finishedat',$this->finishedat,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('target',$this->target,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('meta',$this->meta,true);
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
	 * @return PushJobs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
