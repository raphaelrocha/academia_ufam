<?php

class RelatorioCpfForm extends CFormModel
{
	public $CPF;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('CPF', 'required'),
			array('CPF', 'length', 'max'=>14),
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
			'verifyCode'=>'Verification Code',
		);
	}
}
