<?php

/**
 * This is the model class for table "ACADEMIA".
 *
 * The followings are the available columns in table 'ACADEMIA':
 * @property integer $CODIGO_CONFIG
 * @property integer $CAPACIDADE
 * @property string $HORA_ABERTURA
 * @property string $HORA_FECHAMENTO
 * @property string $DURACAO_PERIODO
 * @property string $TIPOFUNCIONAMENTO
 * @property string $DATA_INICIO
 * @property string $DATA_FIM
 * @property string $SITUACAO
 *
 * The followings are the available model relations:
 * @property AGENDA[] $aGENDAs
 */
class Academia extends CActiveRecord
{
	/**
	* @return string the associated database table name
	*/
	public function tableName()
	{
		return 'ACADEMIA';
	}

	/**
	* @return array validation rules for model attributes.
	*/
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CODIGO_CONFIG, CAPACIDADE, HORA_ABERTURA, HORA_FECHAMENTO, DURACAO_PERIODO, TIPOFUNCIONAMENTO, DATA_INICIO, DATA_FIM, SITUACAO, COTA', 'required'),
			array('CAPACIDADE', 'numerical', 'integerOnly'=>true),
			array('TIPOFUNCIONAMENTO', 'length', 'max'=>20),
			array('SITUACAO', 'length', 'max'=>10),
			array('COTA', 'length', 'max'=>3),
//			array('HORA_ABERTURA', 'date', 'format'=>'HH:ii:ss', 'message'=>'{attribute} have wrong format'),
//			array('date', 'type', 'type' => 'date', 'message' => 'DATA_FIM: is not a date!', 'dateFormat' => 'YYYY-mm-dd'),
//			array('DATA_INICIO', 'date', 'format'=>'YYYY-m-d H:m:s'),
//			array('DATA_FIM', 'date', 'format'=>'YYYY-m-d H:m:s'),
			//array('DATA_INICIO', 'isValidDateIni'),
			array('CAPACIDADE', 'validaQtde'),
			array('DATA_FIM', 'isValidDateFim'),
			array('HORA_FECHAMENTO', 'isValidTime'),
//			array('CODIGO_CONFIG, CAPACIDADE','isValidNumber'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CODIGO_CONFIG, CAPACIDADE, HORA_ABERTURA, HORA_FECHAMENTO, DURACAO_PERIODO, TIPOFUNCIONAMENTO, DATA_INICIO, DATA_FIM, SITUACAO, PERIODO, COTA', 'safe', 'on'=>'search'),
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
			'aGENDAs' => array(self::HAS_MANY, 'AGENDA', 'ID_ACADEMIA'),
		);
	}

	/**
	* @return array customized attribute labels (name=>label)
	*/
	public function attributeLabels()
	{
		return array(
			'CODIGO_CONFIG' => 'Codigo Config',
			'CAPACIDADE' => 'Capacidade',
			'HORA_ABERTURA' => 'Hora Abertura',
			'HORA_FECHAMENTO' => 'Hora Fechamento',
			'DURACAO_PERIODO' => 'Duracao Periodo',
			'TIPOFUNCIONAMENTO' => 'Tipofuncionamento',
			'DATA_INICIO' => 'Data Inicio',
			'DATA_FIM' => 'Data Fim',
			'SITUACAO' => 'Situacao',
			'COTA' => 'Cota',
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

		$criteria->compare('CODIGO_CONFIG',$this->CODIGO_CONFIG);
		$criteria->compare('CAPACIDADE',$this->CAPACIDADE);
		$criteria->compare('HORA_ABERTURA',$this->HORA_ABERTURA,true);
		$criteria->compare('HORA_FECHAMENTO',$this->HORA_FECHAMENTO,true);
		$criteria->compare('DURACAO_PERIODO',$this->DURACAO_PERIODO,true);
		$criteria->compare('TIPOFUNCIONAMENTO',$this->TIPOFUNCIONAMENTO,true);
		$criteria->compare('DATA_INICIO',$this->DATA_INICIO,true);
		$criteria->compare('DATA_FIM',$this->DATA_FIM,true);
		$criteria->compare('SITUACAO',$this->SITUACAO,true);
		$criteria->compare('PERIODO',$this->PERIODO,true);
		$criteria->compare('COTA',$this->COTA,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	* Returns the static model of the specified AR class.
	* Please note that you should have this exact method in all your CActiveRecord descendants!
	* @param string $className active record class name.
	* @return Academia the static model class
	*/
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	//funciona para o caso de verificar se a data está no formato válido
	/*public function isValidDateIni($attribute, $params)
	{
		$currentDate = date("Y-m-d");
		if(!strtotime($this->$attribute) || strtotime($this->$attribute) >= strtotime($currentDate))
		{
			$this->addError($attribute, $attribute . ' Não é uma data válida');
		}
	}*/
	public function isValidDateFim($attribute, $params)
	{

		//if(!strtotime($this->$attribute) || strtotime($this->DATA_INICIO) >= strtotime($this->DATA_FIM))
		if($this->$attribute<=$this->DATA_INICIO)
		{
			$this->addError($attribute,'Data final deve ser superior a data inicial.');
		}
	}
	//erro

	public function isValidTime($attribute, $params)
	{
		/*$pattern = "/^(?:0[1-9]|1[0-2]):[0-5][0-9] (am|pm|AM|PM)$/";

		if(preg_match($pattern,$attribute)){
				return true;
 		}*/

		if($this->$attribute<=$this->HORA_ABERTURA){
			$this->addError($attribute,'Hora de fechamento deve ser superior a hora de abertura.');
		}
	}

	public function validaQtde($attribute, $params){

		if($this->$attribute  % 2 != 0){
			$this->addError($attribute, $attribute . ' Informe um valor PAR para capacidade.');
		}

	}

	/*public function beforeSave() {
		$dao = new Dao;
		$ret = $dao->contaMarcacoesDaAcademia($this->CODIGO_CONFIG);
		if($ret>0){
			$this->addError('Marcações', 'Este perfil já possui marcações e não pode ser alterado.');
		}else{
			return true; //don't forget this
		}


	}*/

	/*public function isValidNumber($attribute, $params)
	{

		if($attribute < 1)
		{
			$this->addError($attribute, ' O número do código ou o número de capacidade não é válido');
		}
	}*/
}
