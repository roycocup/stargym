<?php

/**
 * This is the model class for table "teachers".
 *
 * The followings are the available columns in table 'teachers':
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $facebook
 * @property string $next_wage_date
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Wages[] $wages
 */
class Teachers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Teachers the static model class
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
		return 'teachers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name', 'required'),
			array('first_name, last_name', 'length', 'max'=>50),
			array('email', 'length', 'max'=>200),
			array('phone, facebook', 'length', 'max'=>250),
			array('next_wage_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, first_name, last_name, email, phone, facebook, next_wage_date, created, modified', 'safe', 'on'=>'search'),
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
			'wages' => array(self::HAS_MANY, 'Wages', 'teacher_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email' => 'Email',
			'phone' => 'Phone',
			'facebook' => 'Facebook',
			'next_wage_date' => 'Next Wage Date',
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('next_wage_date',$this->next_wage_date,true);
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