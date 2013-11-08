<?php
	function lookup() {
		include('../variables/variables.php');
		
		$business = str_replace(' ', '+', strtolower($_GET['business']));
       		$state = strtolower($_GET['state']);
		$response = file_get_contents($sangria_url.'name='.$business.'&state='.$state);
		/*$response = json_decode($response);*/
		return $response;
	}

$results = lookup();

if($results == "") {
        $results = "No Results";
}

echo $results;

?>
