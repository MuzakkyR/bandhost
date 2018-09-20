@if(Auth::user()->role == "admin")
<ul id="dropdown1" class="dropdown-content">
    <li>            <a class="col s12" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="material-icons left">subdirectory_arrow_right</i>Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form> </li>
</ul>
<nav class="grey darken-4">
    <div class="nav-wrapper">
      <a href="/" class="brand-logo">Bandhost</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="col s12" href="/after/dashboard"><i class="material-icons left">home</i>Dashboard</a></li>
        <li><a class="col s12" href="/after/user"><i class="material-icons left">account_circle</i>Profil</a></li>
        <li><a class="col s12" href="/after/domain"><i class="material-icons left">blur_circular</i>Domain</a></li>
        <li><a class="col s12" href="/after/hosting"><i class="material-icons left">cloud</i>Hosting</a></li>
        <li><a class="col s12" href="/after/article"><i class="material-icons left">content_paste</i>Article</a></li>
        <li><a class="col s12" href="/after/access"><i class="material-icons left">supervisor_account</i>Access</a></li>
        <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons left">account_circle</i>
            {{ Auth::user()->username }}<i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li>
            <div class="userView">
                <div class="background">
                    <img src="{{ Auth::user()->picture }}">
                </div>
            <a href="#!user"><i class="large material-icons left">account_circle</i></a>
            <a href="#!name"><span class="white-text name">{{ Auth::user()->username }}</span></a>
            <a href="#!email"><span class="white-text email">{{ Auth::user()->email }}</span></a>
            </div>
        </li>
        <li><a class="col s12" href="/after/dashboard"><i class="material-icons left">home</i>Dashboard</a></li>
        <li><a class="col s12" href="/after/user"><i class="material-icons left">account_circle</i>Profil</a></li>
        <li><a class="col s12" href="/after/domain"><i class="material-icons left">blur_circular</i>Domain</a></li>
        <li><a class="col s12" href="/after/hosting"><i class="material-icons left">cloud</i>Hosting</a></li>
        <li><a class="col s12" href="/after/article"><i class="material-icons left">content_paste</i>Article</a></li>
        <li><a class="col s12" href="/after/access"><i class="material-icons left">supervisor_account</i>Access</a></li>
        <li><a class="col s12" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="material-icons left">subdirectory_arrow_right</i>Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form></li>
      </ul>
    </div>
</nav>
@else
<ul id="dropdown1" class="dropdown-content">
    <li>            <a class="col s12" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="material-icons left">subdirectory_arrow_right</i>Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form> </li>
</ul>
<nav class="teal">
    <div class="nav-wrapper container">
      <a href="/" class="brand-logo">Bandhost</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="col s12" href="/after/dashboard"><i class="material-icons left">home</i>Dashboard</a></li>
        <li><a class="col s12" href="/after/user"><i class="material-icons left">account_circle</i>Profil</a></li>
        <li><a class="col s12" href="/after/domain"><i class="material-icons left">blur_circular</i>Domain</a></li>
        <li><a class="col s12" href="/after/hosting"><i class="material-icons left">cloud</i>Hosting</a></li>
        <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons left">account_circle</i>
            {{ Auth::user()->username }}<i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li>
            <div class="userView">
                <div class="background">
                    <img src="{{ Auth::user()->picture }}">
                </div>
            <a href="#!user"><img class="circle" src="{{ Auth::user()->picture }}"></a>
            <a href="#!name"><span class="white-text name">{{ Auth::user()->username }}</span></a>
            <a href="#!email"><span class="white-text email">{{ Auth::user()->email }}</span></a>
            </div>
        </li>
        <li><a class="col s12" href="/after/dashboard"><i class="material-icons left">home</i>Dashboard</a></li>
        <li><a class="col s12" href="/after/user"><i class="material-icons left">account_circle</i>Profil</a></li>
        <li><a class="col s12" href="/after/domain"><i class="material-icons left">blur_circular</i>Domain</a></li>
        <li><a class="col s12" href="/after/hosting"><i class="material-icons left">cloud</i>Hosting</a></li>
        <li><a class="col s12" href="/after/article"><i class="material-icons left">content_paste</i>Article</a></li>
        <li><a class="col s12" href="/after/access"><i class="material-icons left">supervisor_account</i>Access</a></li>
        <li><a class="col s12" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="material-icons left">subdirectory_arrow_right</i>Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form></li>
      </ul>
    </div>
</nav>
@endif