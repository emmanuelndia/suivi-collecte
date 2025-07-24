<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Suivi des collectes</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="{{asset('logo_2.ico')}}">
    <!-- FontAwesome JS (CDN) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <style>
        .password-container {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        #toggleEye {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            cursor: pointer;
            z-index: 100;
            padding: 0;
            line-height: 1;
            outline: none;
            opacity: 1 !important;
            visibility: visible !important;
        }
        #toggleEye:hover, #toggleEye:focus, #toggleEye:active {
            opacity: 1 !important;
            visibility: visible !important;
            display: inline-block !important;
        }
        #eyeIcon {
            font-size: 0.85rem;
            color: #333;
            opacity: 1 !important;
            visibility: visible !important;
            display: inline-block !important;
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900 !important;
        }
        #eyeIcon.fa-eye::before {
            content: "\f06e" !important; /* Code Unicode pour fa-eye */
        }
        #eyeIcon.fa-eye-slash::before {
            content: "\f070" !important; /* Code Unicode pour fa-eye-slash */
        }
        .fa-eye, .fa-eye-slash {
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900 !important;
        }
        .form-control.password {
            padding-right: 2.75rem;
            height: 2.5rem;
        }
    </style>
</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4">
                        <a class="app-logo" href="index.html">
                            <img class="logo-icon me-2" src="{{ asset('logo_2.png') }}" alt="logo">
                        </a>
                    </div>
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
                                <input id="login" name="login" type="text" class="form-control" placeholder="Entrez votre nom d'utilisateur" required="required">
                            </div>
                            <div class="password mb-3">
                                <label class="sr-only" for="password">Mot de passe</label>
                                <div class="password-container position-relative">
                                    <input id="password" name="password" type="password" class="form-control password" placeholder="Entrez votre mot de passe" required="required">
                                    <button type="button" id="toggleEye" aria-label="Afficher ou masquer le mot de passe">
                                        <i class="fa-solid fa-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Se connecter</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
            <div class="auth-background-holder"></div>
            <div class="auth-background-mask"></div>
            <div class="auth-background-overlay p-3 p-lg-5"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleEye = document.getElementById('toggleEye');
            const passwordInput = document.getElementById('password');

            if (toggleEye && passwordInput) {
                console.log('Éléments trouvés : toggleEye, passwordInput');
                toggleEye.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Clic détecté, type actuel :', passwordInput.type);

                    // Créer un nouvel élément <i> pour forcer le re-rendu
                    const newIcon = document.createElement('i');
                    newIcon.id = 'eyeIcon';
                    newIcon.style.fontSize = '0.85rem';
                    newIcon.style.color = '#333';
                    newIcon.style.opacity = '1';
                    newIcon.style.visibility = 'visible';
                    newIcon.style.display = 'inline-block';

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        newIcon.className = 'fa-solid fa-eye-slash';
                        console.log('Icône changée en fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        newIcon.className = 'fa-solid fa-eye';
                        console.log('Icône changée en fa-eye');
                    }

                    // Remplacer l'ancienne icône par la nouvelle
                    const oldIcon = document.getElementById('eyeIcon');
                    if (oldIcon) {
                        oldIcon.parentNode.replaceChild(newIcon, oldIcon);
                    }
                });
            } else {
                console.error('Erreur : Un ou plusieurs éléments (toggleEye, passwordInput) sont introuvables.');
            }
        });
    </script>
</body>
</html>
