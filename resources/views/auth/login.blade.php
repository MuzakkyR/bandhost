@extends('frontlayout.master')

@section('page-css')
    <link rel="stylesheet" type="text/css" href="/css/join.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
@endsection

@section('main-content')
    <div class="join-wrap">
        <div class="join-form">
            <div class="section">
                <a href="{{ url('/') }}" class="nav-btn waves-effect waves-light btn-large join-btn">Frontsite</a> 
                <a href="{{ url('/register') }}" class="nav-btn waves-effect waves-light btn-large join-btn">Register</a> 
            </div>
            <div class="divider"></div>
            <div id="login">
                <form role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="input-field">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="username" value="{{ old('username') }}" name="username" type="text" class="validate" required="true" minlength="6">
                        <label for="username">Username</label>
                    </div>
                    @if($errors->has('username'))
                        <p class="error-msg">Wrong username or password</p>
                    @endif
                    <div class="input-field">
                        <i class="material-icons prefix">lock_outline</i>
                        <input id="password" name="password" type="password" class="validate" required="true" minlength="6">
                        <label for="password">Password</label>
                    </div>
                     <button class="btn waves-effect waves-light" type="submit" name="action">Login</button>
            </div>
        </div>
    </div>
@endsection


@section('javascript')
    <script type="text/javascript">
        $(document).ready(function(){
            $("a.brand-logo").addClass("center");
            $("ul").addClass("hilang");
        });
    </script>
@endsection