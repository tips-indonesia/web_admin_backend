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
    <script type="text/javascript">
        function sendMessage() {
            console.log("sending post message")
            window.opener.postMessage(window.location.href, '*')
        }
    </script>
</head>
<body>
    <script type="text/javascript">
        function x_redirect(uri) {
          if(navigator.userAgent.match(/Android/i)) 
            document.location = uri;
          else
            window.location.replace(uri);
        }
            

        function checkframechange(src){
            // setInterval(() => {
            //     console.log("sending post message")
            //     window.opener.postMessage(window.location.href, '*')
            // }, 500)
            // window.addEventListener('click', function(e) {
            //     console.log("sending post message")
            //     window.opener.postMessage(window.location.href, '*')
            // }, false);
            console.log("src: ", src);
            console.log("print 4: ", src.substr(0, 4));
            var test = "https://tips"
            if(src.substr(0, test.length) == test) {
                x_redirect(SGOSignature.getIframeURL(src));
            }
        }
    </script>
    <div class="loader"></div>
    <iframe id="sgoplus-iframe" src="" scrolling="no" onLoad="checkframechange(this.src);" frameborder="0" display="none"></iframe>
    @if (App\Http\Controllers\API\PaymentController::isDev())
    <script type="text/javascript" src="https://sandbox-kit.espay.id/public/signature/js"></script>
    @else
    <script type="text/javascript" src="https://kit.espay.id/public/signature/js"></script>
    @endif
    <script type="text/javascript">
        function submit() {
            var data = {
                @if (App\Http\Controllers\API\PaymentController::isDev())
                key: "d1df1e4dc0075d52b721a9c2a67598ee",
                @else
                key: "c2d89090e55d92971ac26b13f5a9bf22",
                @endif
                paymentId: "<?php echo $payData['payment_id'] ?>",
                backUrl: "<?php echo $payData['callback_url'] ?>",
                bankCode: "<?php echo $payData['bankCode'] ?>",
                bankProduct: "<?php echo $payData['bankProduct'] ?>"
            }
            sgoPlusIframe = document.getElementById("sgoplus-iframe");
            if (sgoPlusIframe !== null) sgoPlusIframe.src = SGOSignature.getIframeURL(data);
            SGOSignature.receiveForm();
        };
        // console.log("add popstate listener")
        // window.addEventListener('popstate', () => {
        //     console.log("sending post message")
        //     window.opener.postMessage(window.location.href, '*')
        // })

        setInterval(() => {
            console.log('my link', window.location.href)
            console.log("sending post message")
            window.opener.postMessage(window.location.href, '*')
        }, 500)
        window.onload = function() {
            submit();
        };

    </script>

</body>
</html>

<!-- OLD -->
<!-- <!DOCTYPE html>
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
</html> -->