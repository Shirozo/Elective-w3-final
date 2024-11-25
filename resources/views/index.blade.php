<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{ asset("js/bootstrap.bundle.js") }}"></script>
    @vite(["resources/css/app.css"])
</head>

<body>
    @include("base.navbar")

    <div class="custom-container">
        @include("base.sidenav")
        <div class="content">
            @yield("main")
        </div>
    </div>
</body>

</html>
