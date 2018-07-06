<?php
//dependency import
require 'properties.php';
require 'lib/Slim/Slim.php';
require 'security/Security.php';

//init Slim Framework
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app->add(new \Security($app));
require 'security/Login.php';
require 'security/ManageUser.php';

//resources
	//db SSU_db
		require('./resource/SSU_db/custom/AccountCustom.php');
		require('./resource/SSU_db/Account.php');
		require('./resource/SSU_db/custom/CashFlowCustom.php');
		require('./resource/SSU_db/CashFlow.php');
		require('./resource/SSU_db/custom/UserCustom.php');
		require('./resource/SSU_db/User.php');
	

$app->run();


?>
