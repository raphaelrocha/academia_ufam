<?php
class Criptografia{
	/*public function encript($senhaNormal){
		$salt = openssl_random_pseudo_bytes(22); // É necessário usar OpenSSL.
		$salt = '$2a$%13$' . strtr(base64_encode($salt), array('_' => '.', '~' => '/'));

		$senhaCript = crypt($senhaNormal,$salt);

		return $senhaCript;
	}*/

	public function encrypt($text)
	{
		/*$salt ='$2a$';
		return trim(base64_encode(mcrypt_encrypt(MCRYPT_BLOWFISH,
												 $salt,
												 $text,
												 MCRYPT_MODE_ECB,
												 mcrypt_create_iv(mcrypt_get_iv_size(
													 MCRYPT_RIJNDAEL_256,
													 MCRYPT_MODE_ECB),
																  MCRYPT_RAND))));*/
		return md5($text);
	}

	/*public function decrypt($text)
	{
		$salt ='$2a$';
		return trim(mcrypt_decrypt(MCRYPT_BLOWFISH,
								   $salt,
								   base64_decode($text),
								   MCRYPT_MODE_ECB,
								   mcrypt_create_iv(mcrypt_get_iv_size(
									   MCRYPT_RIJNDAEL_256,
									   MCRYPT_MODE_ECB),
													MCRYPT_RAND)));
	}*/
}
?>
