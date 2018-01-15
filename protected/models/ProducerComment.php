<?php

/**
 * This is the model class for table "producer_comment".
 *
 * The followings are the available columns in table 'producer_comment':
 * @property integer $id
 * @property string $producerID
 * @property string $userID
 * @property double $rating
 * @property string $content
 * @property string $createTime
 * @property integer $isPostFb
 * @property string $photo
 * @property string $fbPostID
 * @property string $reply
 * @property string $replyTime
 */
class ProducerComment extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'producer_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('producerID, userID, createTime', 'required'),
			array('isPostFb', 'numerical', 'integerOnly'=>true),
			array('rating', 'numerical'),
			array('producerID, userID, photo, fbPostID', 'length', 'max'=>255),
			array('content, reply, replyTime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, producerID, userID, rating, content, createTime, isPostFb, photo, fbPostID, reply, replyTime', 'safe', 'on'=>'search'),
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
			'producerID' => 'Producer',
			'userID' => 'User',
			'rating' => 'Rating',
			'content' => 'Content',
			'createTime' => 'Create Time',
			'isPostFb' => 'Is Post Fb',
			'photo' => 'Photo',
			'fbPostID' => 'Fb Post',
			'reply' => 'Reply',
			'replyTime' => 'Reply Time',
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
		$criteria->compare('producerID',$this->producerID,true);
		$criteria->compare('userID',$this->userID,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('isPostFb',$this->isPostFb);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('fbPostID',$this->fbPostID,true);
		$criteria->compare('reply',$this->reply,true);
		$criteria->compare('replyTime',$this->replyTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProducerComment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
