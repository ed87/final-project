<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.header')
    </head>

    <body class="d-flex flex-column min-vh-100">
        <div id="app">
            @include('includes.nav')
           
            @include('includes.messages')

            <main class="pb-4">
                @yield('content')
            </main>
        </div>
        @include('includes.footer')
    </body>
</html>
