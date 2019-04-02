<?php 

	

	session_start();

	require_once "phpmailer/PHPMailerAutoload.php";

	//$php_autoload = "phpmailer/PHPMailerAutoload.php";


	spl_autoload_register(function($class){

		require_once "classes/".$class.".php";

	});



	$GLOBALS['config'] = array(

		'mysql' => array(

			'host' => '127.0.0.1',
			'dbname' => 'test',
			'user' => 'root', 
			'password' =>'root'
		),


		'session' => array(

			'session_name' => 'user',
			'token_name' => 'token'

		),


		'cookie' => array(

			'cookie_name' => 'hash',
			'cookie_expiry' => 604800

		)

	);




	


