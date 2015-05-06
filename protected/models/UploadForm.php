<?php
class UploadForm extends CFormModel {
	//public $URL;
	public $DESCRICAO;
	public $ARQUIVO;
	public function rules () {
		return array (
			//array('URL', 'length', 'max'=>500),
			//array('DESCRICAO', 'required'),
			//array('DESCRICAO', 'length', 'max'=>1000),
			array ('ARQUIVO', 'file', 'types' => 'gif, jpg, png, pdf', 'allowEmpty'=>true),
		);
	}
}
