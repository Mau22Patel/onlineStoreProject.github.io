<?php
// Connection to the database

$server = "localhost";
$user = "root"; 
$pass = ""; 
$database = "perfectcuppadb"; 

try 
{

    $mysqli = new mysqli($server, $user, $pass, $database);
} 
catch (Exception $ex)
{
    error_log($ex->getMessage());
    exit("Error connecting to the database"); 
}


