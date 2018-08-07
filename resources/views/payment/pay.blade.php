<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        .loader {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="loader"></div>
    <script type="text/javascript"src="https://sandbox-kit.espay.id/public/signature/js"></script>
    <script type="text/javascript"> 
        console.log("Tips TEST");

        window.onload = function() {
            console.log("Tips TEST 2");
            var data = {
                key: "d1df1e4dc0075d52b721a9c2a67598ee",
                paymentId: "<?php echo $payData['payment_id'] ?>",
                backUrl: "<?php echo $payData['callback_url'] ?>",
                bankCode: "<?php echo $payData['bankCode'] ?>",
                bankProduct: "<?php echo $payData['bankProduct'] ?>"
            }

            function x_redirect(uri) {
              if(navigator.userAgent.match(/Android/i)) 
                document.location = uri;      
              else
                window.location.replace(uri);
            }
            x_redirect(SGOSignature.getIframeURL(data));

            SGOSignature.receiveForm();
            console.log("Tips TEST 3");
        };
    </script>

</body>
</html>