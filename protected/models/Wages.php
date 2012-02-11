<?php

/**
 * This is the model class for table "wages".
 *
 * The followings are the available columns in table 'wages':
 * @property string $id
 * @property string $teacher_id
 * @property integer $amount
 * @property integer $payed
 * @property string $set_date
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Teachers $teacher
 */
class Wages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Wages the static model class
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
		return 'wages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('teacher_id, payed', 'required'),
			array('amount, payed', 'numerical', 'integerOnly'=>true),
			array('teacher_id', 'length', 'max'=>10),
			array('set_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, teacher_id, amount, payed, set_date, created, modified', 'safe', 'on'=>'search'),
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
			'teacher' => array(self::BELONGS_TO, 'Teachers', 'teacher_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'teacher_id' => 'Teacher',
			'amount' => 'Amount',
			'payed' => 'Payed',
			'set_date' => 'Set Date',
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
		$criteria->compare('teacher_id',$this->teacher_id,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('payed',$this->payed);
		$criteria->compare('set_date',$this->set_date,true);
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