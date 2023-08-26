<?php
	ob_start();

	require_once 'vendor/autoload.php';
	require_once 'app/routes/web.php';

	ob_end_flush();