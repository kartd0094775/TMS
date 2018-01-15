<?php

/**
 * This is the model class for table "coupon_s".
 *
 * The followings are the available columns in table 'coupon_s':
 * @property string $id
 * @property integer $status
 * @property integer $isSticky
 * @property string $producerId
 * @property integer $mainType
 * @property integer $subType
 * @property string $area
 * @property string $name
 * @property integer $total
 * @property integer $countSold
 * @property integer $countClick
 * @property integer $countFavor
 * @property integer $originPrice
 * @property integer $specialPrice
 * @property string $start
 * @property string $end
 * @property string $expire
 * @property string $photo
 * @property string $description
 * @property string $limitation
 * @property string $availableStore
 * @property string $updatedat
 * @property string $createdat
 */
class CouponS extends _Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'coupon_s';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, status, isSticky, producerId, mainType, subType, area, name, total, countSold, countClick, countFavor, originPrice, specialPrice, start, end, expire, photo, description, limitation, availableStore, updatedat, createdat', 'required'),
			array('status, isSticky, mainType, subType, total, countSold, countClick, countFavor, originPrice, specialPrice', 'numerical', 'integerOnly'=>true),
			array('id, producerId', 'length', 'max'=>36),
			array('area, name', 'length', 'max'=>255),
			array('photo', 'length', 'max'=>1024),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, status, isSticky, producerId, mainType, subType, area, name, total, countSold, countClick, countFavor, originPrice, specialPrice, start, end, expire, photo, description, limitation, availableStore, updatedat, createdat', 'safe', 'on'=>'search'),
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
			'isSticky' => 'Is Sticky',
			'producerId' => 'Producer',
			'mainType' => 'Main Type',
			'subType' => 'Sub Type',
			'area' => 'Area',
			'name' => 'Name',
			'total' => 'Total',
			'countSold' => 'Count Sold',
			'countClick' => 'Count Click',
			'countFavor' => 'Count Favor',
			'originPrice' => 'Origin Price',
			'specialPrice' => 'Special Price',
			'start' => 'Start',
			'end' => 'End',
			'expire' => 'Expire',
			'photo' => 'Photo',
			'description' => 'Description',
			'limitation' => 'Limitation',
			'availableStore' => 'Available Store',
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
		$criteria->compare('isSticky',$this->isSticky);
		$criteria->compare('producerId',$this->producerId,true);
		$criteria->compare('mainType',$this->mainType);
		$criteria->compare('subType',$this->subType);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('countSold',$this->countSold);
		$criteria->compare('countClick',$this->countClick);
		$criteria->compare('countFavor',$this->countFavor);
		$criteria->compare('originPrice',$this->originPrice);
		$criteria->compare('specialPrice',$this->specialPrice);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('expire',$this->expire,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('limitation',$this->limitation,true);
		$criteria->compare('availableStore',$this->availableStore,true);
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
	 * @return CouponS the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
