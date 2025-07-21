{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/css/connexion.css')}}">
    <title>Connexion</title>
</head>
<body>





    <div id="container">

        <section id="texte">
            <span class="text1">Plateforme de gestion -</span> Suivi des personnes collectés
        </section>

        <section id="connexion">

            <div id="img"><img src=""></div>
            <h1>Entrez vos paramètres d'authentification</h1>
             @if (Session::get('error_msg'))
                    <b>{{ Session::get('error_msg') }}</b>
            @endif

            <form method="post" action="{{route('handleLogin')}}">
                @csrf
                @method('POST')
                <label for="login">Nom d'utilisateur</label>
                <input type="text" name="login" id="login" required>
                <label for="password">Mot de passe</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" required>
                    <button type="button" id="toggleEye" aria-label="Afficher ou masquer le mot de passe">
                        <i class="fa-solid fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
                <input type="submit" value="Se connecter">

            </form>
        </section>

    </div>

</body>
</html>
 --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Suivi des collectes</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="{{asset('logo_2.ico')}}">

    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="{{ asset('logo_2.png') }}" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Suivi des personnes collectées</h2>
			        <div class="auth-form-container text-start">

						<form method="post" action="{{route('handleLogin')}}" class="auth-form login-form">
                            @if (Session::get('error_msg'))
                                    <b>{{ Session::get('error_msg') }}</b>
                            @endif

                            @csrf
                            @method('POST')

							<div class="login mb-3">
								<label class="sr-only" for="login">Login</label>
								<input id="login" name="login" type="text" class="form-control " placeholder="Entrez votre nom d'utilisateur" required="required">
							</div><!--//form-group-->
							<div class="password mb-3">
								<label class="sr-only" for="password">Password</label>
								<input id="password" name="password" type="password" class="form-control password" placeholder="Entrez votre mot de passe" required="required">
								{{-- <div class="extra mt-3 row justify-content-between">
									<div class="col-6">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="RememberPassword">
											<label class="form-check-label" for="RememberPassword">
											Remember me
											</label>
										</div>
									</div><!--//col-6-->
									<div class="col-6">
										<div class="forgot-password text-end">
											<a href="reset-password.html">Mot de passe oublié ?</a>
										</div>
									</div><!--//col-6-->
								</div><!--//extra--> --}}
							</div><!--//form-group-->
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button>
							</div>
						</form>

						{{-- <div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="signup.html" >here</a>.</div> --}}

					</div><!--//auth-form-container-->

			    </div><!--//auth-body-->


		    </div><!--//flex-column-->
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">
		    </div>
		    <div class="auth-background-mask"></div>
		    <div class="auth-background-overlay p-3 p-lg-5">
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->

    </div><!--//row-->


</body>
</html>


