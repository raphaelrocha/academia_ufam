<?php

/**
 * This is the model class for table "AGENDA".
 *
 * The followings are the available columns in table 'AGENDA':
 * @property integer $ID
 * @property string $MAT_USUARIO
 * @property integer $ID_HORARIO
 * @property integer $IDCEL
 * @property integer $DATA_SELECAO
 * @property integer $FALTA
 * @property integer $ID_RESP_MARC
 *
 * The followings are the available model relations:
 * @property USUARIO $mATUSUARIO
 * @property HORARIO $iDHORARIO
 * @property ACADEMIA $iDACADEMIA
 */
class Agenda extends CActiveRecord
{
	/**
	* @return string the associated database table name
	*/
	public function tableName()
	{
		return 'AGENDA';
	}

	/**
	* @return array validation rules for model attributes.
	*/
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MAT_USUARIO, ID_HORARIO, IDCEL, DATA_SELECAO, FALTA, ID_RESP_MARC', 'required'),
			array('ID_HORARIO, FALTA', 'numerical', 'integerOnly'=>true),
			array('MAT_USUARIO', 'length', 'max'=>20),
			array('ID_RESP_MARC', 'length', 'max'=>20),
			array('IDCEL', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, MAT_USUARIO, ID_HORARIO, IDCEL, DATA_SELECAO, FALTA, ID_RESP_MARC', 'safe', 'on'=>'search'),
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
			'mATUSUARIO' => array(self::BELONGS_TO, 'USUARIO', 'MAT_USUARIO'),
			'iDHORARIO' => array(self::BELONGS_TO, 'HORARIO', 'ID_HORARIO'),
		);
	}

	/**
	* @return array customized attribute labels (name=>label)
	*/
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'MAT_USUARIO' => 'Mat Usuario',
			'ID_HORARIO' => 'Id Horario',
			'IDCEL' => 'Id Cel',
			'DATA_SELECAO' => 'Data de seleção',
			'FALTA' => 'Falta',
			'ID_RESP_MARC' => 'Resp Seleção',
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
		$criteria->compare('MAT_USUARIO',$this->MAT_USUARIO,true);
		$criteria->compare('ID_HORARIO',$this->ID_HORARIO);
		$criteria->compare('IDCEL',$this->ID_HORARIO);
		$criteria->compare('DATA_SELECAO',$this->DATA_SELECAO);
		$criteria->compare('FALTA',$this->FALTA);
		$criteria->compare('ID_RESP_MARC',$this->ID_RESP_MARC);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	* Returns the static model of the specified AR class.
	* Please note that you should have this exact method in all your CActiveRecord descendants!
	* @param string $className active record class name.
	* @return Agenda the static model class
	*/
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
