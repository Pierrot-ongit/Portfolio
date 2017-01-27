<?php

class Password
{
	public function hash($password)
	{
		$salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);

        // Voir la documentation de crypt() : http://devdocs.io/php/function.crypt
        return crypt($password, $salt);
	}

	public function check($password, $hash)
	{
		if(!function_exists('hash_equals')) 
		{
		 	function hash_equals($str1, $str2)
		 	{
		    	if(strlen($str1) != strlen($str2))
		    	{
		      		return false;
		    	} 
		    	else 
		    	{
		      		$res = $str1 ^ $str2;
		      		$ret = 0;
		      		for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
		      			return !$ret;
		    	}
		  	}
		}

		return hash_equals($hash, crypt($password, $hash));
	}
}