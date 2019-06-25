<?php
include_once 'api.php';

$api = new Api();
if(isset($_GET['id'])){
	$id = $_GET['id'];

	if(is_numeric($id)){
		$api->getById($id);
	} else{
		$api->error('Parameters are not correct');
	}
	
} else {
	$api->getAll();
}


?>