<?php

/**
 * This is the model class for table "restricao".
 *
 * The followings are the available columns in table 'restricao':
 * @property string $ID
 * @property string $SITUACAO
 * @property string $HORAINICIO
 * @property string $HORAFIM
 */
class Restricao extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	public function tableName()
	{
		return 'RESTRICAO';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SITUACAO, HORAINICIO, HORAFIM, LIBERA_ALMOCO', 'required'),
			array('SITUACAO, LIBERA_ALMOCO', 'length', 'max'=>10),
			array('HORAFIM', 'isValidTime'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, SITUACAO, HORAINICIO, HORAFIM, LIBERA_ALMOCO', 'safe', 'on'=>'search'),
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
			'ID' => 'ID',
			'SITUACAO' => 'Situacao',
			'HORAINICIO' => 'Horainicio',
			'HORAFIM' => 'Horafim',
			'LIBERA_ALMOCO' => 'Liberação para horário de almoço',
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

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('SITUACAO',$this->SITUACAO,true);
		$criteria->compare('HORAINICIO',$this->HORAINICIO,true);
		$criteria->compare('HORAFIM',$this->HORAFIM,true);
		$criteria->compare('LIBERA_ALMOCO',$this->LIBERA_ALMOCO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Restricao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function isValidTime($attribute, $params)
	{
		/*$pattern = "/^(?:0[1-9]|1[0-2]):[0-5][0-9] (am|pm|AM|PM)$/";

		if(preg_match($pattern,$attribute)){
				return true;
 		}*/

		if($this->$attribute<=$this->HORAINICIO){
			$this->addError($attribute, $attribute . ' Hora final deve ser superior a hora inicial.');
		}
	}

}
