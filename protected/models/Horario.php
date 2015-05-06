<?php

/**
 * This is the model class for table "HORARIO".
 *
 * The followings are the available columns in table 'HORARIO':
 * @property integer $ID
 * @property integer $ID_ACADEMIA
 * @property string $DIASEMANA
 * @property string $PERIODO
 * @property string $HORAINICIO
 * @property string $HORAFIM
 * @property integer $TOTAL_USO
 *
 * The followings are the available model relations:
 * @property AGENDA[] $aGENDAs
 */
class Horario extends CActiveRecord
{
	/**
	* @return string the associated database table name
	*/
	public function tableName()
	{
		return 'HORARIO';
	}

	/**
	* @return array validation rules for model attributes.
	*/
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, ID_ACADEMIA, DIASEMANA, PERIODO, HORAINICIO, HORAFIM, TOTAL_USO, MAX_ALUNO, MAX_FUNC', 'required'),
			array('ID_ACADEMIA, TOTAL_USO', 'numerical', 'integerOnly'=>true),
			array('DIASEMANA', 'length', 'max'=>15),
			array('PERIODO', 'length', 'max'=>10),
			//array('DATADIA', 'isValidDateDia'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, ID_ACADEMIA, DIASEMANA, PERIODO, HORAINICIO, HORAFIM, TOTAL_USO, MAX_ALUNO, MAX_FUNC', 'safe', 'on'=>'search'),
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
			'aGENDAs' => array(self::HAS_MANY, 'AGENDA', 'ID_HORARIO'),
		);
	}

	/**
	* @return array customized attribute labels (name=>label)
	*/
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'ID_ACADEMIA' => 'ID_ACADEMIA',
			//'DATADIA' => 'Datadia',
			'DIASEMANA' => 'Diasemana',
			'PERIODO' => 'Periodo',
			'HORAINICIO' => 'Horainicio',
			'HORAFIM' => 'Horafim',
			'TOTAL_USO' => 'Total Uso',
			'MAX_ALUNO' => 'Max Aluno',
			'MAX_FUNC' => 'Max Servidor',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('ID_ACADEMIA',$this->ID_ACADEMIA);
		//$criteria->compare('DATADIA',$this->DATADIA,true);
		$criteria->compare('DIASEMANA',$this->DIASEMANA,true);
		$criteria->compare('PERIODO',$this->PERIODO,true);
		$criteria->compare('HORAINICIO',$this->HORAINICIO,true);
		$criteria->compare('HORAFIM',$this->HORAFIM,true);
		$criteria->compare('TOTAL_USO',$this->TOTAL_USO);
		$criteria->compare('MAX_ALUNO',$this->MAX_ALUNO);
		$criteria->compare('MAX_FUNC',$this->MAX_FUNC);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	* Returns the static model of the specified AR class.
	* Please note that you should have this exact method in all your CActiveRecord descendants!
	* @param string $className active record class name.
	* @return Horario the static model class
	*/
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function isValidDateDia($attribute, $params)
	{

		$currentDate = date("d-m-Y");
		$currentDateLessOne = date("Y-m-d",strtotime("-1 year"));
		if(!strtotime($this->$attribute) || strtotime($this->$attribute) >= strtotime($currentDate) || strtotime($this->$attribute) <= strtotime($currentDateLessOne))
		{
			$this->addError($attribute, $attribute . ' Não é uma data válida');
		}
	}


}
