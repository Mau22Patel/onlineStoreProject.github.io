<?php
//Start the session
session_start(); 
if (isset($_SESSION['email']))
{
	//Read the values from the session	
    $first_name = $_SESSION["firstName"]; 
    $last_name = $_SESSION["lastName"]; 
    $phone = $_SESSION["telephone"]; 
    $email = $_SESSION ["email"]; 
	
    //Display a welcome message
    echo "<h2> Welcome back $first_name $last_name<h2>"; 
    echo "<p> Email: $email </p>"; 
    echo "<p> Phone: $phone </P>"; 
	echo"<h2><p><p><p> <a href=logout.php>Logout </a> </p></p></p></h2> ";
    echo"<h2><p><p><p> <a href=index.php>home </a> </p></p></p></h2> ";
}
else
{
	//redirect back to login form if not authorized
    header ("Location:login.php"); 
    exit(); 
  	
}
?>
