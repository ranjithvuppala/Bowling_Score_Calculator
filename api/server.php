<?php

require dirname(__FILE__).'/sum.php';

// Receive the input from POST
$postdata = file_get_contents("php://input");
$json_obj = json_decode($postdata,false);

//Send the JSON object to sum.php to calculate sum
$i = count($json_obj->frames);
$send_response = sum($json_obj->frames);

//Send the result back to the frontend
echo(json_encode($send_response));

?>