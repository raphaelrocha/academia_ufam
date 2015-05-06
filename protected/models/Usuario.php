<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property string $MATRICULA
 * @property string $NOME
 * @property string $SEXO
 * @property string $DATANASC
 * @property string $CURSO
 * @property string $TIPO
 * @property string $SENHA
 * @property string $EMAIL
 *
 * The followings are the available model relations:
 * @property Agenda[] $agendas
 */
class Usuario extends CActiveRecord
{
	public $SENHA_REPETE;
	public $initialPassword;
	/**
	* @return string the associated database table name
	*/
	public function tableName()
	{
		return 'USUARIO';
	}

	/**
	* @return array validation rules for model attributes.
	*/
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MATRICULA, NOME, SOBRENOME, SEXO, DATANASC , ALUNO, CURSO, UNIDADE, TIPO, EMAIL, SITUACAO', 'required'),
			array('MATRICULA', 'length', 'max'=>20),
			array('NOME, SOBRENOME, CURSO, EMAIL', 'length', 'max'=>50),
			array('CURSO, UNIDADE', 'length', 'max'=>10),
			array('FUNCIONARIO, ALUNO', 'length', 'max'=>3),
			array('SEXO, TIPO', 'length', 'max'=>50),
			array('EMAIL', 'email'),
			array('SENHA', 'required','message'=>'O campo Senha deve ser preenchido.'/*, 'on'=>'insert'*/),
			array('SENHA_REPETE', 'required','message'=>'O campo Repita sua Senha deve ser preenchido.'/*, 'on'=>'insert'*/),
			array('SENHA, SENHA_REPETE', 'length', 'min'=>3, 'max'=>32,'message'=>'A senha deve conter no máximo 10 caracteres.'),
			array('SENHA', 'compare', 'compareAttribute'=>'SENHA_REPETE','message'=>'Os campos Senha e Repita sua Senha, não conferem.'),
			//array('DATANASC', 'isValidDateNasc'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('MATRICULA, NOME, SOBRENOME, SEXO, DATANASC, CURSO, UNIDADE, TIPO, SENHA, EMAIL, SITUACAO', 'safe', 'on'=>'search'),
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
			'agendas' => array(self::HAS_MANY, 'Agenda', 'MAT_USUARIO'),
		);
	}

	/**
	* @return array customized attribute labels (name=>label)
	*/
	public function attributeLabels()
	{
		return array(
			'MATRICULA' => 'CPF',
			'NOME' => 'Nome',
			'SOBRENOME' => 'Sobrenome',
			'SEXO' => 'Sexo',
			'DATANASC' => 'Data de nascimento',
			'FUNCIONARIO' => 'Servidor',
			'FUNCIONARIO_QUESTION' => 'Funcionário da UFAM?',
			'UNIDADE' => 'Unidade',
			'ALUNO' => 'Aluno',
			'CURSO' => 'Curso',
			'TIPO' => 'Tipo',
			'SENHA' => 'Senha',
			'EMAIL' => 'e-Mail',
			'SITUACAO' => 'Situação',
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
		$criteria->condition = "MATRICULA <> '".Yii::app()->params['root']."'"; //NÃO MOSTA O USUARIO DEFINIDO COMO ROOT

		$criteria->compare('MATRICULA',$this->MATRICULA,true);
		$criteria->compare('NOME',$this->NOME,true);
		$criteria->compare('SOBRENOME',$this->SOBRENOME,true);
		$criteria->compare('SEXO',$this->SEXO,true);
		$criteria->compare('DATANASC',$this->DATANASC,true);
		$criteria->compare('FUNCIONARIO',$this->FUNCIONARIO,true);
		$criteria->compare('UNIDADE',$this->UNIDADE,true);
		$criteria->compare('ALUNO',$this->ALUNO,true);
		$criteria->compare('CURSO',$this->CURSO,true);
		$criteria->compare('TIPO',$this->TIPO,true);
		$criteria->compare('SENHA',$this->SENHA,true);
		$criteria->compare('EMAIL',$this->EMAIL,true);
		$criteria->compare('SITUACAO',$this->SITUACAO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>50,
			)));
	}

	/**
	* Returns the static model of the specified AR class.
	* Please note that you should have this exact method in all your CActiveRecord descendants!
	* @param string $className active record class name.
	* @return Usuario the static model class
	*/
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave()
	{
		// in this case, we will use the old hashed password.
		if(empty($this->SENHA) && empty($this->SENHA_REPETE) && !empty($this->initialPassword))
			$this->SENHA=$this->SENHA_REPETE=$this->initialPassword;

		return parent::beforeSave();
	}

	/*public function afterFind()
	{
		//reset the password to null because we don't want the hash to be shown.
		$this->initialPassword = $this->SENHA;
		$this->SENHA = null;

		parent::afterFind();
	}*/

	public function saveModel($data=array())
	{
		//because the hashes needs to match
		if(!empty($data['SENHA']) && !empty($data['SENHA_REPETE']))
		{
			$data['SENHA'] = Yii::app()->user->hashPassword($data['SENHA']);
			$data['SENHA_REPETE'] = Yii::app()->user->hashPassword($data['SENHA_REPETE']);
		}

		$this->attributes=$data;

		if(!$this->save())
			return CHtml::errorSummary($this);

		return true;
	}
	/*
	public function isValidDateNasc($attribute, $params)
	{
		$currentDateLess16 = date("Y-m-d",strtotime("-16 year"));
		$currentDateLess70 = date("Y-m-d",strtotime("-70 year"));
		if(!strtotime($this->$attribute) || strtotime($this->$attribute) >= strtotime($currentDateLess16) || strtotime($this->$attribute) <= strtotime($currentDateLess70))
		{
			$this->addError($attribute, $attribute . ' Não é uma data válida');
		}
	}*/
}
