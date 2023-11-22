<?php

require_once 'startup.php';

header("Content-Type: application/json");
echo json_encode(Unit::GetPersonRep()->listPerson());