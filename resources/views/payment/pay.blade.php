<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <script type="text/javascript"src="https://sandbox-kit.espay.id/public/signature/js"></script>
    <script type="text/javascript"> 
        window.onload = function() {
            var data = {
                key: "d1df1e4dc0075d52b721a9c2a67598ee",
                paymentId: "<?php echo $payData['payment_id'] ?>",
                backUrl: "<?php echo $payData['callback_url'] ?>"
            },

            window.location.href = SGOSignature.getIframeURL(data);

            SGOSignature.receiveForm();
        };
    </script>

</body>
</html>