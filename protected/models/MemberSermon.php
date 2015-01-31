<?php

/**
 * This is the model class for table "membersermon".
 *
 * The followings are the available columns in table 'membersermon':
 * @property integer $ID
 * @property integer $MEMBERID
 * @property integer $SERMONDATEID
 */
class MemberSermon extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'membersermon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MEMBERID, SERMONDATEID', 'required'),
			array('MEMBERID, SERMONDATEID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, MEMBERID, SERMONDATEID', 'safe', 'on'=>'search'),
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
			'mEMBER' => array(self::BELONGS_TO, 'Member', 'MEMBERID'),
			'sERMONDATE' => array(self::BELONGS_TO, 'Sermondate', 'SERMONDATEID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'Id',
			'MEMBERID' => 'Memberid',
			'SERMONDATEID' => 'Sermondateid',
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
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);

		$criteria->compare('MEMBERID',$this->MEMBERID);

		$criteria->compare('SERMONDATEID',$this->SERMONDATEID);

		return new CActiveDataProvider('MemberSermon', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return MemberSermon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}