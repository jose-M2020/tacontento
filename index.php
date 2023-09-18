<?php
	
	ob_start();
	session_start();
	
	// $variables = require_once('app/variables.php');
	require_once('app/config/constants.php');
		
	require_once 'vendor/autoload.php';
	require_once 'app/routes/web.php';

	ob_end_flush();