<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <!-- loader-->
    <link href="{{ asset('backend/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>
    <!--favicon-->
    <link rel="icon" href="{{ asset('backend/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Vector CSS -->
    <link href="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <!-- simplebar CSS-->
    <link href="{{ asset('backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="{{ asset('backend/assets/css/animate.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <!-- Metismenu CSS-->
    <link href="{{ asset('backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- Custom Style-->
    <link href="{{ asset('backend/assets/css/custom/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/app-style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/summernote/dist/summernote-bs4.css') }}" />
    <!-- latest jquery-->
    <script src="/plugins/js/sweet_alert.js" defer></script>
    <script src="/backend/assets/js/jquery.min.js"></script>
    <script src="{{ asset('backend/assets/plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/inputtags/js/bootstrap-tagsinput.js') }}"></script>
    @vite(['resources/js/backend/Views/Admin/app.js'])
</head>

<body class="bg-theme bg-theme1" id="body">
    <div id="app">
        <app></app>
    </div>
</body>

</html>
