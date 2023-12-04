<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script
        src="https://www.paypal.com/sdk/js?client-id=ATsXThlRKQMIDRsC0xX-EWt57Vg_FkznXcQNTrWdHgT-X2337ZiEuWGnnOgtubRXGfMJICcIOZ_lZ6aY&currency=MXN">
    </script>

</head>

<body>
    <div id="paypal-button-container"></div>
    <script>
    paypal.Buttons({
        style: {
            color: 'blue',
            shape: 'pill',
            label: 'pay'
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '100.00' // Make sure to use a string for the value
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            actions.order.capture().then(function(details) {
                // Extract values from the details object
                var purchaseUnit = details.purchase_units[0];
                var amount = purchaseUnit.amount.value;
                var currencyCode = purchaseUnit.amount.currency_code;
                var estado = details.status;
                // Log or use the extracted values
                console.log(details);
                console.log("Amount:", amount);
                console.log("Currency Code:", currencyCode);
                console.log("estado:", estado);


            });
        },
        // Payment canceled
        onCancel: function(data) {
            alert('Payment canceled');
            console.log(data);
        }
    }).render('#paypal-button-container');
    </script>
</body>

</html>