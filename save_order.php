<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - A Perfect Cuppa</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to the shared CSS file -->
</head>
<body>

<div id="login">
        <div id="loginwrapper"></div>
<?php
//Start the session
session_start();
include 'cart.php';
$cart = new Cart();
$counter= $_SESSION['counter'];
require_once("conn_db.php"); 
require_once('gen_id.php');
//Set the email
$email = "testseller@selleraccount.com";   	
if ($counter==0){
echo"<br><br><p><b> Your Shopping Cart is empty !!! </b></p>";
}
else {
		//Convert the cart string to a cart object
		$cart = unserialize($_SESSION['cart']);
		$depth = $cart->get_depth();
		//Generate the order id
		$orderID = gen_id(8);
		$total_price = 0;
		//Use a for loop to Iterate through the cart
		for ($i=0; $i<$depth; $i++) {
			$product = $cart->get_product($i);
			$product_id = $product->get_product_id();
			$qty = $product->get_qty();
			$unit_price = $product->get_unit_price();
			$total_price = $total_price + ($unit_price*$qty);
			//Add the record to order_line table
			//Create the insert query for the order_details table
			$query = "INSERT INTO orderdetails (orderID, productID, qty) VALUES (?, ?, ?)";
			try {
				$stmt = $mysqli->prepare($query);
				// Bind the parameters
				$stmt->bind_param("ssi", $orderID, $product_id, $qty);
				// Execute the query
				$stmt->execute();
			} catch (Exception $e) {
				error_log($e->getMessage());
				exit('Error inserting to order details table');
			}
			
		}
		//Add the record to order table
		$status = "Paid";
		//Create the insert query for the orders table
		$totalAmount = $total_price; 
		$query = "INSERT INTO orders (orderID, email, totalAmount, status) VALUES (?, ?, ?, ?)";
		try {
			$stmt = $mysqli->prepare($query);
			// Bind parameters
			$stmt->bind_param("ssds", $orderID, $email, $totalAmount, $status,);
			// Execute the query
			$stmt->execute();
			echo "<p><b>Order added! Order ID: $orderID</b></p>";
		} catch (Exception $e) {
			error_log($e->getMessage());
			exit('Error inserting to order table');
		}
		
		$message = "Thanks for your order, your order ID is $orderID";
		//Email or display the invoice
		@mail($email, "Order confirmation", $message); 
		echo $message; 
		
		//Empty the cart
		$mysqli->close();
		unset($_SESSION['counter']);
		unset($_SESSION['cart']);
		echo"<p><b> <a href=products.php>Go back to Products </a> </b></p>";
	
}
?>
