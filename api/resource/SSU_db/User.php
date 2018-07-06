<?php
	require_once './db/dbSSU_dbManager.php';
	
/*
 * SCHEMA DB User
 * 
	{
		mail: {
			type: 'String'
		},
		name: {
			type: 'String'
		},
		password: {
			type: 'String', 
			required : true
		},
		roles: {
			type: 'String'
		},
		surname: {
			type: 'String'
		},
		username: {
			type: 'String', 
			required : true
		},
		//RELAZIONI
		
		
		//RELAZIONI ESTERNE
		
		accountid: {
			type: Schema.ObjectId,
			ref : "User"
		},
		userid: [{
			type: Schema.ObjectId,
			ref : "CashFlow"
		}],
		
	}
 * 
 */


//CRUD METHODS


//CRUD - CREATE


$app->post('/Users',	function () use ($app){

	$body = json_decode($app->request()->getBody());
	
	$params = array (
		'mail'	=> isset($body->mail)?$body->mail:'',
		'name'	=> isset($body->name)?$body->name:'',
		'password'	=> $body->password,
		'roles'	=> isset($body->roles)?$body->roles:'',
		'surname'	=> isset($body->surname)?$body->surname:'',
		'username'	=> $body->username,
		
		'accountid' => isset($body->accountid)?$body->accountid:'',

	);

	$obj = makeQuery("INSERT INTO user (_id, mail, name, password, roles, surname, username , accountid )  VALUES ( null, :mail, :name, :password, :roles, :surname, :username , :accountid   )", $params, false);
        
	
	echo json_encode($body);
	
});
	
//CRUD - REMOVE

$app->delete('/Users/:id',	function ($id) use ($app){
	
	$params = array (
		'id'	=> $id,
	);

	makeQuery("DELETE FROM user WHERE _id = :id LIMIT 1", $params);

});
	
//CRUD - GET ONE
	
$app->get('/Users/:id',	function ($id) use ($app){
	$params = array (
		'id'	=> $id,
	);
	
	$obj = makeQuery("SELECT * FROM user WHERE _id = :id LIMIT 1", $params, false);
	
	
	
	echo json_encode($obj);
	
});
	
	
//CRUD - GET LIST

$app->get('/Users',	function () use ($app){
	makeQuery("SELECT * FROM user");
});


//CRUD - EDIT

$app->post('/Users/:id',	function ($id) use ($app){

	$body = json_decode($app->request()->getBody());
	
	$params = array (
		'id'	=> $id,
		'mail'	    => isset($body->mail)?$body->mail:'',
		'name'	    => isset($body->name)?$body->name:'',
		'password'	    => $body->password,
		'roles'	    => isset($body->roles)?$body->roles:'',
		'surname'	    => isset($body->surname)?$body->surname:'',
		'username'	    => $body->username,
		'accountid'      => isset($body->accountid)?$body->accountid:'' 

	);

	$obj = makeQuery("UPDATE user SET  mail = :mail,  name = :name,  password = :password,  roles = :roles,  surname = :surname,  username = :username  , accountid=:accountid  WHERE _id = :id LIMIT 1", $params, false);
        
	
	echo json_encode($body);
    	
});


/*
 * CUSTOM SERVICES
 *
 *	These services will be overwritten and implemented in  Custom.js
 */


/*
 Name: changePassword
 Description: Change password of user from admin
 Params: 
 */
$app->post('/Users/:id/changePassword',	function ($key) use ($app){	
	makeQuery("SELECT 'ok' FROM DUAL");
});
	
			
?>