<?php

class Session
{
	public function __construct()
	{
		if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
	}

	public function set($name, $data)
	{
		$_SESSION[$name] = $data;
	}

	public function get($name)
	{
		if(!isset($_SESSION[$name]))
			return null;

		return $_SESSION[$name];
	}

	public function destroy()
    {
        $_SESSION = [];
        session_destroy();
    }
}