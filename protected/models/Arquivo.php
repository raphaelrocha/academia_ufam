<?php

/**
 * This is the model class for table "arquivo".
 *
 * The followings are the available columns in table 'arquivo':
 * @property string $ID
 * @property string $MAT_USUARIO
 * @property integer $ID_ACADEMIA
 * @property string $DATAHORA
 * @property string $DESCRICAO
 * @property string $NOMEARQUIVO
 * @property string $URL
 *
 * The followings are the available model relations:
 * @property Usuario $mATUSUARIO
 */
class Arquivo extends CActiveRecord
{
	/**
	* @return string the associated database table name
	*/
	public function tableName()
	{
		return 'ARQUIVO';
	}

	/**
	* @return array validation rules for model attributes.
	*/
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MAT_USUARIO, ID_ACADEMIA, URL', 'required'),
			array('ID_ACADEMIA', 'numerical', 'integerOnly'=>true),
			array('MAT_USUARIO', 'length', 'max'=>20),
			array('DESCRICAO', 'length', 'max'=>1000),
			array('NOMEARQUIVO', 'length', 'max'=>500),
			array('URL', 'length', 'max'=>500),
			array('PERIODO', 'length', 'max'=>10),
			array('DATAHORA', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, MAT_USUARIO, ID_ACADEMIA, DATAHORA, DESCRICAO, URL, PERIODO', 'safe', 'on'=>'search'),
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
			'mATUSUARIO' => array(self::BELONGS_TO, 'Usuario', 'MAT_USUARIO'),
		);
	}

	/**
	* @return array customized attribute labels (name=>label)
	*/
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'MAT_USUARIO' => 'CPF',
			'ID_ACADEMIA' => 'Id Academia',
			'DATAHORA' => 'Data / Hora',
			'DESCRICAO' => 'Descrição',
			'NOMEARQUIVO' => 'Nome do Arquivo',
			'URL' => 'Link',
			'PERIODO' => 'Período',
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
		$criteria->compare('MAT_USUARIO',$this->MAT_USUARIO,true);
		$criteria->compare('ID_ACADEMIA',$this->ID_ACADEMIA);
		$criteria->compare('DATAHORA',$this->DATAHORA,true);
		$criteria->compare('DESCRICAO',$this->DESCRICAO,true);
		$criteria->compare('NOMEARQUIVO',$this->NOMEARQUIVO,true);
		$criteria->compare('URL',$this->URL,true);
		$criteria->compare('PERIODO',$this->PERIODO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function searchId($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare($id,$this->ID,true);
		$criteria->compare('MAT_USUARIO',$this->MAT_USUARIO,true);
		$criteria->compare('ID_ACADEMIA',$this->ID_ACADEMIA);
		$criteria->compare('DATAHORA',$this->DATAHORA,true);
		$criteria->compare('DESCRICAO',$this->DESCRICAO,true);
		$criteria->compare('NOMEARQUIVO',$this->NOMEARQUIVO,true);
		$criteria->compare('URL',$this->URL,true);
		$criteria->compare('PERIODO',$this->PERIODO,true);

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
	* @return Arquivo the static model class
	*/
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
