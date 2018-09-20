<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
            <!-- Material Icon -->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <!-- Materialize CSS -->
        <link rel="stylesheet" type="text/css" href="/css/materialize.css">
            <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="/css/frontmaster.css">  
            <!-- Other CSS -->
        @yield('page-css') 
    </head>
    <body>
        <header id="Home" class="scrollspy">
            <!-- navbar -->
            @yield('navigasi')
            @yield('parallax-header')
        </header>
        <main>
            @yield('main-content')
        </main>
        <footer>
            @yield('footer')
        </footer>
        <!-- SCRIPTS -->
        

        <!-- JQuery -->
        <script type="text/javascript" src="js/jquery-3.1.1.js"></script>

        <!-- Bootstrap core Maerialize-->
        <script type="text/javascript" src="js/materialize.js"></script>
        @yield('javascript')
    </body>
</html>