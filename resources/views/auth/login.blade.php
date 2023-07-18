<!DOCTYPE html>
<html lang="en">
<head>
	<title>LOGIN SIPAK</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/auth/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/auth/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/auth/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/auth/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/auth/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/auth/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/auth/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/auth/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/auth/css/util.css">
	<link rel="stylesheet" type="text/css" href="/auth/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url('/auth/images/bg-01.jpg');">
					<span class="login100-form-title-1">
						SIPAK<br>
                        (Sitem Peminjaman Aset Alat Kantor)
					</span>
				</div>

				<form class="login100-form validate-form" action="{{ route('login') }}" method="POST">
                    @csrf
					<div class="wrap-input100 m-b-26">
						<span class="label-input100" style="margin-left:-50px">NIP</span>
						@error('nip') <p class="text-danger">{{ $message }}</p>@enderror
						<input class="input100" type="text" name="nip" placeholder="Masukan NIP" autocomplete="off">
					</div>

					<div class="wrap-input100 m-b-18">
						@error('password') <p class="text-danger">{{ $message }}</p>@enderror
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Masukan Password"> 
					</div>

					{{-- <form method="POST" action="{{ route('login') }}">
						@csrf --}}
					<div class="container-login100-form-btn" style="margin-left:60%;margin-bottom:-50%">
                        <br>
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="/auth/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/auth/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/auth/vendor/bootstrap/js/popper.js"></script>
	<script src="/auth/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/auth/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/auth/vendor/daterangepicker/moment.min.js"></script>
	<script src="/auth/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/auth/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/auth/js/main.js"></script>

</body>
</html>