<?php

/**
 * This is the model class for table "user_rating".
 *
 * The followings are the available columns in table 'user_rating':
 * @property string $id
 * @property integer $type
 * @property string $objId
 * @property double $score
 * @property string $uid
 * @property string $createdat
 */
class UserRating extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_rating';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, objId, score, uid, createdat', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('score', 'numerical'),
			array('objId, uid', 'length', 'max'=>36),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, objId, score, uid, createdat', 'safe', 'on'=>'search'),
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
			'objId' => 'Obj',
			'score' => 'Score',
			'uid' => 'Uid',
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
		$criteria->compare('objId',$this->objId,true);
		$criteria->compare('score',$this->score);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('createdat',$this->createdat,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserRating the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
