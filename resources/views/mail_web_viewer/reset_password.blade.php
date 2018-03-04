<!DOCTYPE html>
<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <!-- Include the above in your HEAD tag -->
    <title>Reset Password</title>
</head>
<body>
    <div class="container">
        <div id="passwordreset" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Password Reset</div>
                    <div style="float:right; font-size: 85%; position: relative; top:-10px">visit <a id="signinlink" href="/">TIPS</a></div>
                </div>  
                <div class="panel-body" >
                    <form id="signupform" method="POST" action="/api/reset_password" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="email" class="col-md-3 control-label">Enter New Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password" placeholder="Enter your new password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-3 control-label">Re-enter New Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="repassword" placeholder="Your new password again">
                            </div>
                        </div>
                        

                        <input type="hidden" value="{{ $reset_password_token }}" name="token" hidden>    
                        <div class="form-group">
                            <!-- Button -->                                        
                            <div class="col-md-offset-3 col-md-9">
                                <button id="btn-signup" type="submit" class="btn btn-warning">Reset</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                    After change the password, you can login normally.
                                </div>
                            </div>
                        </div>    
                        
                    </form>
                 </div>
            </div>
         </div> 
    </div>
</body>
</html>