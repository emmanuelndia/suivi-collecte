
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SUIVI COLLECTE</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="{{asset('logo_2.ico')}}">

    <!-- FontAwesome JS-->
    <script defer src={{asset('assets/plugins/fontawesome/js/all.min.js')}}></script>

    {{-- Alerte sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Icone FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href={{asset('assets/css/portal.css')}}>

</head>

<body class="app">
    <header class="app-header fixed-top">
        @include('layout.topbar')

        @include('layout.sidebar')

    </header><!--//app-header-->

    <div class="app-wrapper">

	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">

                @yield('content')

    </div><!--//app-wrapper-->


    <!-- Javascript -->
    <script src={{asset('assets/plugins/popper.min.js')}}></script>
    <script src={{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}></script>
    <script src={{asset('assets/js/messages.js')}}></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Charts JS -->
    <script src={{asset('assets/plugins/chart.js/chart.min.js')}}></script>
    <script src={{asset('assets/js/index-charts.js')}}></script>

    <!-- Page Specific JS -->
    <script src={{asset('assets/js/app.js')}}></script>

</body>
</html>

