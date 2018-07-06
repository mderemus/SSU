<?php
	require_once './db/dbSSU_dbManager.php';
	
/*
 * SCHEMA DB Account
 * 
	{
		Active: {
			type: 'Boolean'
		},
		Description: {
			type: 'String'
		},
		Name: {
			type: 'String', 
			required : true
		},
		//RELAZIONI
		
		
		//RELAZIONI ESTERNE
		
		accountid: [{
			type: Schema.ObjectId,
			ref : "CashFlow"
		}],
		accountid: {
			type: Schema.ObjectId,
			ref : "User"
		},
		
	}
 * 
 */


//CRUD METHODS


//CRUD - CREATE


$app->post('/accounts',	function () use ($app){

	$body = json_decode($app->request()->getBody());
	
	$params = array (
		'Active'	=> isset($body->Active)?$body->Active:'',
		'Description'	=> isset($body->Description)?$body->Description:'',
		'Name'	=> $body->Name,
		

	);

	$obj = makeQuery("INSERT INTO account (_id, Active, Description, Name )  VALUES ( null, :Active, :Description, :Name   )", $params, false);
        
	
	echo json_encode($body);
	
});
	
//CRUD - REMOVE

$app->delete('/accounts/:id',	function ($id) use ($app){
	
	$params = array (
		'id'	=> $id,
	);

	makeQuery("DELETE FROM account WHERE _id = :id LIMIT 1", $params);

});
	
//CRUD - GET ONE
	
$app->get('/accounts/:id',	function ($id) use ($app){
	$params = array (
		'id'	=> $id,
	);
	
	$obj = makeQuery("SELECT * FROM account WHERE _id = :id LIMIT 1", $params, false);
	
	
	
	echo json_encode($obj);
	
});
	
	
//CRUD - GET LIST

$app->get('/accounts',	function () use ($app){
	makeQuery("SELECT * FROM account");
});


//CRUD - EDIT

$app->post('/accounts/:id',	function ($id) use ($app){

	$body = json_decode($app->request()->getBody());
	
	$params = array (
		'id'	=> $id,
		'Active'	    => isset($body->Active)?$body->Active:'',
		'Description'	    => isset($body->Description)?$body->Description:'',
		'Name'	    => $body->Name

	);

	$obj = makeQuery("UPDATE account SET  Active = :Active,  Description = :Description,  Name = :Name   WHERE _id = :id LIMIT 1", $params, false);
        
	
	echo json_encode($body);
    	
});


/*
 * CUSTOM SERVICES
 *
 *	These services will be overwritten and implemented in  Custom.js
 */

			
?>