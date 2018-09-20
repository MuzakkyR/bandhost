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
        <link rel="stylesheet" type="text/css" href="/css/join.css">  
    </head>
    <body>
        <main>
            <div class="join-wrap">
                <div class="join-form">
                    <div class="section">
                        <a href="{{ url('/') }}" class="nav-btn waves-effect waves-light btn-large join-btn">Frontsite</a> 
                        <a href="@yield('join-url')" class="nav-btn waves-effect waves-light btn-large join-btn">@yield('join-btn')</a>
                    </div>
                    <div class="divider"></div>
                    <div>
                        <form role="form" method="POST" action="@yield('route')">
                        {{ csrf_field() }}
                            @yield('main-content')
                         </form>
                    </div>
                    
                </div>
            </div>
        </main>
        <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript" src="js/jquery-3.1.1.js"></script>

        <!-- Bootstrap core Maerialize-->
        <script type="text/javascript" src="js/materialize.js"></script>
        @yield('javascript')
    </body>
</html>