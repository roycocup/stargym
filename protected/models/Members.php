<?php

/**
 * This is the model class for table "members".
 *
 * The followings are the available columns in table 'members':
 * @property string $id
 * @property string $slug
 * @property string $first_name
 * @property string $last_name
 * @property string $nickname
 * @property string $email
 * @property string $dob
 * @property integer $picture_id
 * @property string $next_payment_date
 * @property string $created
 * @property string $modified
 */
class Members extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Members the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'members';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, nickname', 'required'),
			array('picture_id', 'numerical', 'integerOnly'=>true),
			array('slug, nickname', 'length', 'max'=>250),
			array('first_name, last_name, email', 'length', 'max'=>100),
			array('dob, next_payment_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, slug, first_name, last_name, nickname, email, dob, picture_id, next_payment_date, created, modified', 'safe', 'on'=>'search'),
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
			'payments' => array(self::HAS_MANY, 'Payments', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'slug' => 'Slug',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'nickname' => 'Nickname',
			'email' => 'Email',
			'dob' => 'Dob',
			'picture_id' => 'Picture',
			'next_payment_date' => 'Next Payment Date',
			'created' => 'Created',
			'modified' => 'Modified',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('picture_id',$this->picture_id);
		$criteria->compare('next_payment_date',$this->next_payment_date,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave()
	{
		if ($this->isNewRecord) {
			$this->created = new CDbExpression('NOW()');
			$this->modified = new CDbExpression('NOW()');
		} else {
			$this->modified = new CDbExpression('NOW()');
		}
		return parent::beforeSave();
	}
}