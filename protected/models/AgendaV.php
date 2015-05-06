<?php

/**
 * This is the model class for table "agenda_v".
 *
 * The followings are the available columns in table 'agenda_v':
 * @property string $MAT_USUARIO
 * @property string $ID_ACADEMIA
 * @property string $HORAINICIO
 * @property string $DIASEMANA
 * @property string $PRESENCA
 * @property string $FALTA
 * @property string $IDCEL
 */
class AgendaV extends CActiveRecord
{
	/**
	* @return string the associated database table name
	*/
	public function tableName()
	{
		return 'AGENDA_V';
	}

	/**
	* @return array validation rules for model attributes.
	*/
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('MAT_USUARIO, ID_ACADEMIA, HORAINICIO, DIASEMANA, PRESENCA, FALTA, IDCEL', 'required'),
			array('MAT_USUARIO, ID_ACADEMIA, HORAINICIO, DIASEMANA, FALTA, IDCEL, TOTAL_USO', 'required'),
			array('MAT_USUARIO', 'length', 'max'=>20),
			array('IDCEL', 'length', 'max'=>10),
			array('ID_ACADEMIA, PRESENCA, FALTA', 'length', 'max'=>10),
			array('DIASEMANA', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('MAT_USUARIO, ID_ACADEMIA, HORAINICIO, DIASEMANA, PRESENCA, FALTA, IDCEL, TOTAL_USO', 'safe', 'on'=>'search'),
			//array('MAT_USUARIO, ID_ACADEMIA, HORAINICIO, DIASEMANA, FALTA, IDCEL', 'safe', 'on'=>'search'),
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
			'MAT_USUARIO' => 'Mat Usuario',
			'ID_ACADEMIA' => 'Id Academia',
			'HORAINICIO' => 'Horainicio',
			'DIASEMANA' => 'Diasemana',
			//'PRESENCA' => 'Presenca',
			'FALTA' => 'Falta',
			'IDCEL' => 'idCel',
			'TOTAL_USO'=>'Capacidade Total',
			//'MAX_ALUNO'=>'Max alunos',
			//'MAX_FUNC'=>'Max funcionários',
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

		$criteria->compare('MAT_USUARIO',$this->MAT_USUARIO,true);
		$criteria->compare('ID_ACADEMIA',$this->ID_ACADEMIA,true);
		$criteria->compare('HORAINICIO',$this->HORAINICIO,true);
		$criteria->compare('DIASEMANA',$this->DIASEMANA,true);
		//$criteria->compare('PRESENCA',$this->PRESENCA,true);
		$criteria->compare('FALTA',$this->FALTA,true);
		$criteria->compare('IDCEL',$this-IDCEL,true);
		$criteria->compare('TOTAL_USO',$this->TOTAL_USO,true);
		//$criteria->compare('MAX_ALUNO',$this->MAX_ALUNO,true);
		//$criteria->compare('MAX_FUNC',$this->MAX_FUNC,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	* Returns the static model of the specified AR class.
	* Please note that you should have this exact method in all your CActiveRecord descendants!
	* @param string $className active record class name.
	* @return AgendaV the static model class
	*/
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
