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
                <a href="{{ url('/login') }}" class="nav-btn waves-effect waves-light btn-large join-btn">Login</a> 
            </div>
            <div class="divider"></div>
            <div id="register">
                <form role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                    <div class="input-field">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="username" value="{{ old('username') }}" name="username" type="text" class="validate">
                        <label for="username">Username</label>
                    </div>
                    @if($errors->has('username'))
                        <p class="error-msg">This Username is already occupied</p>
                    @endif

                    <div class="input-field">
                        <i class="material-icons prefix">local_post_office</i>
                        <input id="email" name="email" type="email" class="validate" required="true" value="{{ old('email') }}">
                        <label for="email" data-error="wrong" data-success="right">Email</label>
                    </div>
                    @if($errors->has('email'))
                        <p class="error-msg">This Email is already occupied</p>
                    @endif

                    <div class="input-field">
                        <i class="material-icons prefix">lock_outline</i>
                        <input id="password" name="password" type="password" class="validate" required="true" minlength="6">
                        <label for="password">Password</label>
                    </div>
                    @if($errors->has('password'))
                        <p class="error-msg">This Password unmatch</p>
                    @endif
                    <div class="input-field">
                        <i class="material-icons prefix">lock_outline</i>
                        <input id="password-confirm" type="password" name="password_confirmation" class="validate" required="true">
                          <label for="password-confirm" >Confirm Password</label>
                    </div>
                    
                    <button class="btn waves-effect waves-light" type="submit" name="submit">Register Now</button>
                </form>
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