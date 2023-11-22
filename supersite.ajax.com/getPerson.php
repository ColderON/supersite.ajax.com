<?php

require_once 'startup.php';

/*$file = Unit::GetPersonRep()->getPerson($_GET['id']);*/

/*$f=fopen("test.txt","a+");
fwrite($f,"\r\nid: {$_GET['id']}");
fclose($f);*/

if(Unit::GetPersonRep()->getPerson($_GET['id'])){
    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(Unit::GetPersonRep()->getPerson($_GET['id']));
}
else{
    http_response_code(400);
}


