<?php

/**
 * This is the model class for table "payments".
 *
 * The followings are the available columns in table 'payments':
 * @property integer $id
 * @property string $member_id
 * @property integer $value
 * @property string $extras
 * @property integer $extras_value
 * @property string $created
 * @property string $modified
 */
class Payments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Payments the static model class
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
		return 'payments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id, value', 'required'),
			array('value, extras_value', 'numerical', 'integerOnly'=>true),
			array('member_id', 'length', 'max'=>10),
			array('extras', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, member_id, value, extras, extras_value, created, modified', 'safe', 'on'=>'search'),
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
			'member' => array(self::BELONGS_TO, 'Members', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'member_id' => 'Member',
			'value' => 'Value',
			'extras' => 'Extras',
			'extras_value' => 'Extras Value',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('member_id',$this->member_id,true);
		$criteria->compare('value',$this->value);
		$criteria->compare('extras',$this->extras,true);
		$criteria->compare('extras_value',$this->extras_value);
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