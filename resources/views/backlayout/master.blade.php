<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
                    <!-- Material Icon -->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <!-- Materialize CSS -->
        <link rel="stylesheet" type="text/css" href="/css/materialize.css">
        <link rel="stylesheet" type="text/css" href="/css/backmaster.css">
    </head>
    <body>
        <header>
            @yield('navigasi')
        </header>
        <main>
            @yield('content')
        </main>
        <footer>
            @yield('footer')
        </footer>
                <!-- JQuery -->
        <script type="text/javascript" src="/js/jquery-3.1.1.js"></script>
        <!-- Bootstrap core Maerialize-->
        <script type="text/javascript" src="/js/materialize.js"></script>
        <script type="text/javascript">

                $(document).ready(function() {
                    $('select').material_select();
                    $(".button-collapse").sideNav();
                    
                });
        </script>
            @yield('js')
    </body>
</html>