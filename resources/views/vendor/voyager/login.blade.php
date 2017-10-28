<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="none" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="admin login">
	<title>Administrator - Login</title>

    
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset("css/icons/icomoon/styles.css") }}" rel="stylesheet" type="text/css">
	<link href="{{ asset("css/bootstrap.css") }}" rel="stylesheet" type="text/css">
	<link href="{{ asset("css/core.css") }}" rel="stylesheet" type="text/css">
	<link href="{{ asset("css/components.css") }}" rel="stylesheet" type="text/css">
	<link href="{{ asset("css/colors.css") }}" rel="stylesheet" type="text/css">
    
    
	<script type="text/javascript" src="{{ asset("js/plugins/loaders/pace.min.js") }}"></script>
	<script type="text/javascript" src="{{ asset("js/core/libraries/jquery.min.js") }}"></script>
	<script type="text/javascript" src="{{ asset("js/core/libraries/bootstrap.min.js") }}"></script>
	<script type="text/javascript" src="{{ asset("js/plugins/loaders/blockui.min.js") }}"></script>

    
	<script type="text/javascript" src="{{ asset("js/plugins/forms/validation/validate.min.js") }}"></script>
	<script type="text/javascript" src="{{ asset("js/plugins/forms/styling/uniform.min.js") }}"></script>

	<script type="text/javascript" src="{{ asset("js/core/app.js") }}"></script>
	<script type="text/javascript" src="{{ asset("js/pages/login_validation.js") }}"></script>

</head>

<body class="login-container">
	<div class="page-container">
		<div class="page-content">
			<div class="content-wrapper">
				<div class="content pb-20">
					<form action="{{ route('voyager.login') }}" method="POST" class="form-validate">
                        
                        <div class="panel panel-body login-form">
                            {{ csrf_field() }}
							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
								<h5 class="content-group">Login to your account <small class="display-block">Your credentials</small></h5>
							</div>

							<div class="form-group has-feedback has-feedback-left">
                                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('voyager.generic.email') }}" class="form-control" required>
                                <div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
                            <input type="password" name="password" placeholder="{{ __('voyager.generic.password') }}" class="form-control" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>						

							<div class="form-group">
								<button type="submit" class="btn bg-blue btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
							</div>
						</div>
					</form>
                    <div class="footer text-muted text-center">
						&copy; 2017. TIPS Administrator Page
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
