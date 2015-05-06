<?php

/**
 * This is the model class for table "curso".
 *
 * The followings are the available columns in table 'curso':
 * @property string $ID_CURSO
 * @property string $NOME_CURSO
 *
 * The followings are the available model relations:
 * @property Usuario[] $usuarios
 */
class Curso extends CActiveRecord
{
	/**
	* @return string the associated database table name
	*/
	public function tableName()
	{
		return 'CURSO';
	}

	/**
	* @return array validation rules for model attributes.
	*/
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_CURSO, NOME_CURSO', 'required'),
			array('ID_CURSO', 'length', 'max'=>10),
			array('NOME_CURSO', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_CURSO, NOME_CURSO', 'safe', 'on'=>'search'),
		);
	}

	/**
	* @return array relational rules.
	*/
	/*public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'usuarios' => array(self::HAS_MANY, 'Usuario', 'CURSO'),
		);
	}*/

	/**
	* @return array customized attribute labels (name=>label)
	*/
	public function attributeLabels()
	{
		return array(
			'ID_CURSO' => 'Id Curso',
			'NOME_CURSO' => 'Nome Curso',
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

		$criteria->compare('ID_CURSO',$this->ID_CURSO,true);
		$criteria->compare('NOME_CURSO',$this->NOME_CURSO,true);

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
	* @return Curso the static model class
	*/
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
