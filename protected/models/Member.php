<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property integer $ID
 * @property string $FIRSTNAME
 * @property string $LASTNAME
 * @property integer $STATUSID
 * @property string $BIRTHDAY
 */
class Member extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FIRSTNAME, LASTNAME, STATUSID', 'required'),
			array('STATUSID', 'numerical', 'integerOnly'=>true),
			array('FIRSTNAME, LASTNAME', 'length', 'max'=>125),
			array('BIRTHDAY', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, FIRSTNAME, LASTNAME, STATUSID, BIRTHDAY', 'safe', 'on'=>'search'),
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
			'sTATUS' => array(self::BELONGS_TO, 'Status', 'STATUSID'),
			'membersermons' => array(self::HAS_MANY, 'Membersermon', 'MEMBERID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'Id',
			'FIRSTNAME' => 'Firstname',
			'LASTNAME' => 'Lastname',
			'STATUSID' => 'Statusid',
			'BIRTHDAY' => 'Birthday',
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

		$criteria->compare('FIRSTNAME',$this->FIRSTNAME,true);

		$criteria->compare('LASTNAME',$this->LASTNAME,true);

		$criteria->compare('STATUSID',$this->STATUSID);

		$criteria->compare('BIRTHDAY',$this->BIRTHDAY,true);

		return new CActiveDataProvider('Member', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return Member the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}