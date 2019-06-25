<?php
	include_once 'api.php';

	$api = new Api();

	$title = 'Rambo';
	$releaseyear = 1982;

	//if (isset($_POST['title']) && isset($_POST['releaseyear'])) {
		$item = array(
			'title' => $title,
			'releaseyear' => $releaseyear
		);
		$api->add($item);
	/*} else{
		$api->error('Error calling API');
	}*/

	
?>