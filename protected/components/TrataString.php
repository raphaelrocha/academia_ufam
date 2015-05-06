<?php

class TrataString{
	function converte($string)
	{
		return iconv("UTF-8", "ISO-8859-1", $string);
	}
}
