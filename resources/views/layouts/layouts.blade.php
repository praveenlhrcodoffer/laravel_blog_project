<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>@yield('title', 'Laravel Blog')</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
    <link rel="stylesheet" href="{{ asset('css/postShow.css') }}">
</head>

<body>

    <div class="layout-wrapper">

        <div class="layout-inner-wrapper">

            <!-- Navbar ------------------------------------------->
            @include('components.navigation')

            <!-- Page Content ---------------------------------------->
            <div class="content-wrapper">
                @yield('content')
            </div>


            <!-- Footer ---------------------------------------------->
            @include('components.footer')

        </div>

    </div>

</body>

</html>
