<?php
require_once 'startup.php';

//MY___
/*$get=file_get_contents('php://input'); //get php input buffer
$json_get=json_decode($get, false);   //true -array, false-object

$pdo = new PDO("mysql:host=localhost; dbname=student", "student");*/

/*$sql = "INSERT INTO people(firstName, lastName, email, phone) VALUES ('{$json_get->firstName}', '{$json_get->lastName}', '{$json_get->email}', '{$json_get->phone}')";*/
/*$f=fopen("test.txt","a+");
fwrite($f, "\r\n {$sql}");
fclose($f);*/

/*$stmt = $pdo->prepare("INSERT INTO people(firstName, lastName, email, phone) VALUES (?,?,?,?)");

if($stmt->execute([$json_get->firstName, $json_get->lastName, $json_get->email, $json_get->phone])){
    http_response_code(200);
}
else{
    http_response_code(400);
}*/

$get=file_get_contents('php://input'); //get php input buffer
$json_get=json_decode($get, false);   //true -array, false-object

if(Unit::GetPersonRep()->savePerson($json_get->firstName, $json_get->lastName, $json_get->email, $json_get->phone)){
    http_response_code(200);
}
else{
    http_response_code(400);
}