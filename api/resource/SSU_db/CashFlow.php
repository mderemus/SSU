<?php
	require_once './db/dbSSU_dbManager.php';
	
/*
 * SCHEMA DB CashFlow
 * 
	{
		addition: {
			type: 'Boolean'
		},
		amount: {
			type: 'Decimal'
		},
		description: {
			type: 'String'
		},
		transaction_date: {
			type: 'Date'
		},
		//RELAZIONI
		
		
		//RELAZIONI ESTERNE
		
		accountid: [{
			type: Schema.ObjectId,
			ref : "CashFlow"
		}],
		userid: [{
			type: Schema.ObjectId,
			ref : "CashFlow"
		}],
		
	}
 * 
 */


//CRUD METHODS


//CRUD - CREATE


$app->post('/cashflows',	function () use ($app){

	$body = json_decode($app->request()->getBody());
	
	$params = array (
		'addition'	=> isset($body->addition)?$body->addition:'',
		'amount'	=> isset($body->amount)?$body->amount:'',
		'description'	=> isset($body->description)?$body->description:'',
		'transaction_date'	=> isset($body->transaction_date)?$body->transaction_date:'',
		

	);

	$obj = makeQuery("INSERT INTO cashflow (_id, addition, amount, description, transaction_date )  VALUES ( null, :addition, :amount, :description, :transaction_date   )", $params, false);
    
    
	// Delete not in array
	$in = " and id_Account NOT IN (:accountid)";
	$sql = "DELETE FROM CashFlow_accountid WHERE id_CashFlow=:id_CashFlow ";
		
	$params = array (
		'id_CashFlow'	=> $obj['id']
	);
	
	if (isset($body->accountid) && $body->accountid != null && sizeOf($body->accountid) > 0) {
		$sql = $sql.$in;
		$params['accountid'] = join("', '", $body->accountid);
	}
	
	makeQuery($sql, $params, false);
	
	
	// Get actual
	$sql="SELECT id_Account FROM CashFlow_accountid WHERE id_CashFlow=:id";
	$params = array (
		'id'	=> $obj['id'],
	);
    $actual = makeQuery($sql, $params, false);
	$actualArray=[];
	foreach ($actual as $val) {
		array_push($actualArray, $val->id_Account);
	}

	// Insert new
	if (isset($body->accountid)) {
    	foreach ($body->accountid as $id_Account) {
    		if (!in_array($id_Account, $actualArray)){
    			$sql = "INSERT INTO CashFlow_accountid (_id, id_CashFlow, id_Account ) VALUES (null, :id_CashFlow, :id_Account)";
    
    			$params = array (
    				'id_CashFlow'	=> $obj['id'],
    				'id_Account'	=> $id_Account
    			);
        		makeQuery($sql, $params, false);
    		}
    	}
	}
	
	    
    
	// Delete not in array
	$in = " and id_User NOT IN (:userid)";
	$sql = "DELETE FROM CashFlow_userid WHERE id_CashFlow=:id_CashFlow ";
		
	$params = array (
		'id_CashFlow'	=> $obj['id']
	);
	
	if (isset($body->userid) && $body->userid != null && sizeOf($body->userid) > 0) {
		$sql = $sql.$in;
		$params['userid'] = join("', '", $body->userid);
	}
	
	makeQuery($sql, $params, false);
	
	
	// Get actual
	$sql="SELECT id_User FROM CashFlow_userid WHERE id_CashFlow=:id";
	$params = array (
		'id'	=> $obj['id'],
	);
    $actual = makeQuery($sql, $params, false);
	$actualArray=[];
	foreach ($actual as $val) {
		array_push($actualArray, $val->id_User);
	}

	// Insert new
	if (isset($body->userid)) {
    	foreach ($body->userid as $id_User) {
    		if (!in_array($id_User, $actualArray)){
    			$sql = "INSERT INTO CashFlow_userid (_id, id_CashFlow, id_User ) VALUES (null, :id_CashFlow, :id_User)";
    
    			$params = array (
    				'id_CashFlow'	=> $obj['id'],
    				'id_User'	=> $id_User
    			);
        		makeQuery($sql, $params, false);
    		}
    	}
	}
	
	
	
	echo json_encode($body);
	
});
	
//CRUD - REMOVE

$app->delete('/cashflows/:id',	function ($id) use ($app){
	
	$params = array (
		'id'	=> $id,
	);

	makeQuery("DELETE FROM cashflow WHERE _id = :id LIMIT 1", $params);

});
	
//CRUD - GET ONE
	
$app->get('/cashflows/:id',	function ($id) use ($app){
	$params = array (
		'id'	=> $id,
	);
	
	$obj = makeQuery("SELECT * FROM cashflow WHERE _id = :id LIMIT 1", $params, false);
	
	
	$list_accountid = makeQuery("SELECT id_Account FROM CashFlow_accountid WHERE id_CashFlow = :id", $params, false);
	$list_accountid_Array=[];
	foreach ($list_accountid as $val) {
		array_push($list_accountid_Array, $val->id_Account);
	}
	$obj->accountid = $list_accountid_Array;
	
	
	$list_userid = makeQuery("SELECT id_User FROM CashFlow_userid WHERE id_CashFlow = :id", $params, false);
	$list_userid_Array=[];
	foreach ($list_userid as $val) {
		array_push($list_userid_Array, $val->id_User);
	}
	$obj->userid = $list_userid_Array;
	
	
	
	echo json_encode($obj);
	
});
	
	
//CRUD - GET LIST

$app->get('/cashflows',	function () use ($app){
	makeQuery("SELECT * FROM cashflow");
});


//CRUD - EDIT

$app->post('/cashflows/:id',	function ($id) use ($app){

	$body = json_decode($app->request()->getBody());
	
	$params = array (
		'id'	=> $id,
		'addition'	    => isset($body->addition)?$body->addition:'',
		'amount'	    => isset($body->amount)?$body->amount:'',
		'description'	    => isset($body->description)?$body->description:'',
		'transaction_date'	    => isset($body->transaction_date)?$body->transaction_date:''

	);

	$obj = makeQuery("UPDATE cashflow SET  addition = :addition,  amount = :amount,  description = :description,  transaction_date = :transaction_date   WHERE _id = :id LIMIT 1", $params, false);
    
	// Delete not in array
	$in = " and id_Account NOT IN (:accountid)";
	$sql = "DELETE FROM CashFlow_accountid WHERE id_CashFlow=:id_CashFlow ";
	
	$params = array (
		'id_CashFlow'	=> $body->_id
	);
	
	if (isset($body->accountid) && $body->accountid != null && sizeOf($body->accountid) > 0) {
		$sql = $sql.$in;
		$params['accountid'] = join("', '", $body->accountid);
	}
	
	makeQuery($sql, $params, false);
	
	
	// Get actual
	$sql="SELECT id_Account FROM CashFlow_accountid WHERE id_CashFlow=:id";
	$params = array (
		'id'	=> $body->_id,
	);
    $actual = makeQuery($sql, $params, false);
	$actualArray=[];
	foreach ($actual as $val) {
		array_push($actualArray, $val->id_Account);
	}

	// Insert new
	if (isset($body->accountid)) {
    	foreach ($body->accountid as $id_Account) {
    		if (!in_array($id_Account, $actualArray)){
    			$sql = "INSERT INTO CashFlow_accountid (_id, id_CashFlow, id_Account ) VALUES (null, :id_CashFlow, :id_Account)";
    
    			$params = array (
    				'id_CashFlow'	=> $body->_id,
    				'id_Account'	=> $id_Account
    			);
        		makeQuery($sql, $params, false);
    		}
    	}
	}
	
	    
	// Delete not in array
	$in = " and id_User NOT IN (:userid)";
	$sql = "DELETE FROM CashFlow_userid WHERE id_CashFlow=:id_CashFlow ";
	
	$params = array (
		'id_CashFlow'	=> $body->_id
	);
	
	if (isset($body->userid) && $body->userid != null && sizeOf($body->userid) > 0) {
		$sql = $sql.$in;
		$params['userid'] = join("', '", $body->userid);
	}
	
	makeQuery($sql, $params, false);
	
	
	// Get actual
	$sql="SELECT id_User FROM CashFlow_userid WHERE id_CashFlow=:id";
	$params = array (
		'id'	=> $body->_id,
	);
    $actual = makeQuery($sql, $params, false);
	$actualArray=[];
	foreach ($actual as $val) {
		array_push($actualArray, $val->id_User);
	}

	// Insert new
	if (isset($body->userid)) {
    	foreach ($body->userid as $id_User) {
    		if (!in_array($id_User, $actualArray)){
    			$sql = "INSERT INTO CashFlow_userid (_id, id_CashFlow, id_User ) VALUES (null, :id_CashFlow, :id_User)";
    
    			$params = array (
    				'id_CashFlow'	=> $body->_id,
    				'id_User'	=> $id_User
    			);
        		makeQuery($sql, $params, false);
    		}
    	}
	}
	
	
	
	echo json_encode($body);
    	
});


/*
 * CUSTOM SERVICES
 *
 *	These services will be overwritten and implemented in  Custom.js
 */

			
?>