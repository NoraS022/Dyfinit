<?php 
	/*
	*	Build the response for all Dyfinit elements
	*/

	// Fetch the specifications from the client
	$amount = $_POST["amount"]; // The desired amount now
	$offset = $_POST["offset"]; // The amount already provided
	$templateClass = $_POST["template"]; // The class with the template

	// The json response
	$response = new stdClass(); // Empty object
	$response->html = []; // Empty array of html code
	$response->more = False; // Data to collect next time
	$response->failure = False; // Error status

	// Build the template object
	include "template/". $templateClass .".php";
	$reference = new $templateClass();

	// If nothing to fetch
	if(!array_key_exists($offset, $reference->data)){
		// Send back some error status
		$response->failure = True;
	}

	// Collect the html content
	for($i = 0; $i < $amount; $i++){
		if(!array_key_exists($offset + $i, $reference->data)){ // If key dosn't exist, don't add it
			break;
		}
		array_push($response->html, $reference->print_instance($offset + $i)); // Add print to response text array
	}

	// If data to collect next http call
	if(array_key_exists($offset + $amount, $reference->data)){
		$response->more = True;
	}

	// Print the final encoded response
	print json_encode($response);

?>