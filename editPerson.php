<?php

require_once 'startup.php';

$get=file_get_contents('php://input'); //get php input buffer
$json_get=json_decode($get, false);   //true -array, false-object

if(Unit::GetPersonRep()->editPerson($json_get->firstName, $json_get->lastName, $json_get->email, $json_get->phone, $json_get->id)){
    http_response_code(200);
}
else{
    http_response_code(400);
}