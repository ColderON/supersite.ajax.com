<?php

require_once 'startup.php';

/*$file = Unit::GetPersonRep()->deletePerson($_POST['id']);*/

/*$f=fopen("test.txt","a+");
fwrite($f,"\r\nRequest: {$_REQUEST['id']}");
fclose($f);*/


if(Unit::GetPersonRep()->deletePerson($_REQUEST['id_dP'])){
    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(Unit::GetPersonRep()->deletePerson($_REQUEST['id_dP']));
}
else{
    http_response_code(400);
}




