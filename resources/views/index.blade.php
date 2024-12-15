<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{ asset("js/bootstrap.bundle.js") }}"></script>
    @vite(["resources/css/app.css"])
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/dataTables.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.js') }}"></script>
</head>

<body>
    @include("base.navbar")

    <div class="custom-container">
        @yield("sidenav-content")
        <div class="content">
            @yield("main")
        </div>
    </div>

    @yield("modal")
</body>

</html>
