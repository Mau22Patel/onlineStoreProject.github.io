function initPayPalButton() {
    paypal.Buttons({
      style: {
        shape: 'rect',
        color: 'gold',
        layout: 'vertical',
        label: 'paypal',
        
      },
  
      createOrder: function(data, actions) {
        var total_price = document.getElementById("total_price").value;
        console.log(total_price);

        return actions.order.create({
          purchase_units: [{"amount":{"currency_code":"AUD","value":total_price}}]
        });
      },
  
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {
          
          // Full available details
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
  
          // Show a success message within this page, for example:
          window.location.replace("save_order.php");
          
        });
      },
  
      onError: function(err) {
        console.log(err);
        const element = document.getElementById('paypal-button-container');
        element.innerHTML = '';
        element.innerHTML = '<h3>Unable to process the payment</h3>';
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();

  