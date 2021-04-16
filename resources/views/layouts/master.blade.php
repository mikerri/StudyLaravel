<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>@yield('title', 'Laravel Study')</title>

        <!-- bootstrap CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

        @yield('style')
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>

        @yield('script')
    </body>
</html>
