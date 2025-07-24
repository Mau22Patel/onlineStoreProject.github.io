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
        <div id="loginwrapper">

  <?php
    session_start();
    $total_price = $_SESSION["total_price"];
  ?>
    <div class="product-container">
      <div class="product-info-container">
        <h1>Payment</h1>
        <div class="finalPayment">
    <p>
        Total Amount: $<?php echo number_format($total_price, 2); ?>
    </p>
</div>
        <input type="hidden" id="total_price" value=<?php echo $total_price; ?> />
      
        <p>*Terms and Conditions Apply</p>
        <div id="smart-button-container">
          <div style="text-align: center;">
            <div id="paypal-button-container"></div>
          </div>
        </div>
        <script src="https://www.paypal.com/sdk/js?client-id=Aecpp1f1OqC48s_x3gkf8ekVMB11rJcUDL_qkmRThmT7SsiGpqRG3ex2fSyIelB0Hj_57MpJWTnqP4Wg&enable-funding=venmo&currency=AUD" data-sdk-integration-source="button-factory"></script>
        <script type="text/javascript" src="js/script.js"></script>
      </div>
    </div>
  </body>
</html>
