<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <iframe id="sgoplus-iframe" src="" scrolling="no" frameborder="0"></iframe>
    <script type="text/javascript"src="https://sandbox-kit.espay.id/public/signature/js"></script>
    <script type="text/javascript"> 
        window.onload = function() {
            var data = {
                key: "d1df1e4dc0075d52b721a9c2a67598ee",
                paymentId: "<?php echo $payData['payment_id'] ?>",
                backUrl: "<?php echo $payData['callback_url'] ?>"
            },

            sgoPlusIframe = document.getElementById("sgoplus-iframe");
            
            if(sgoPlusIframe !== null) 
                sgoPlusIframe.src = SGOSignature.getIframeURL(data);

            SGOSignature.receiveForm();
        };
    </script>

</body>
</html>