<?php

/**
 * This is the model class for table "user_coupon".
 *
 * The followings are the available columns in table 'user_coupon':
 * @property string $code
 * @property string $userId
 * @property string $couponId
 * @property integer $status
 * @property string $boughtAt
 * @property string $usedAt
 */
class UserCoupon extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_coupon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, userId, couponId, status, boughtAt, usedAt', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('code, userId, couponId', 'length', 'max'=>36),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('code, userId, couponId, status, boughtAt, usedAt', 'safe', 'on'=>'search'),
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
			'couponId' => 'Coupon',
			'status' => 'Status',
			'boughtAt' => 'Bought At',
			'usedAt' => 'Used At',
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
		$criteria->compare('couponId',$this->couponId,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('boughtAt',$this->boughtAt,true);
		$criteria->compare('usedAt',$this->usedAt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserCoupon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
