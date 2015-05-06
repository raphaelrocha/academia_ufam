<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class UsuarioBuscaSieForm extends CFormModel
{
	public $MATRICULA;
	public $FLAG;
	//public $email;
	//public $subject;
	//public $body;
	//public $verifyCode;

	/**
	* Declares the validation rules.
	*/
	public function rules()
	{
		return array(
			array('MATRICULA, FLAG', 'required'),
			array('MATRICULA', 'length', 'max'=>20),
		);
	}

	/**
	* Declares customized attribute labels.
	* If not declared here, an attribute would have a label that is
	* the same as its name with the first letter in upper case.
	*/
	public function attributeLabels()
	{
		return array(
			//'verifyCode'=>'Código de verificação',
			'MATRICULA'=>'CPF',
		);
	}
}
