<?php

$rootDir = realpath(dirname(__FILE__).DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;

spl_autoload_register(function ($className){

    $file = $GLOBALS["rootDir"]."classes".DIRECTORY_SEPARATOR.$className.".php";

   /* $f=fopen("test.txt","a+");
    fwrite($f,"\r\n$file");
    fclose($f);*/


    if(!file_exists($file)){

        return false;
    }
    require_once $file;
    return true;
});

