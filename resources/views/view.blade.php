@extends('frontlayout.master')

@section('navigasi')
    <nav class="white">
        <div class="nav-wrapper">
            <a href="/" class="brand-logo center">Bandhost</a>
        </div>
    </nav>
@endsection

@section('main-content')
<div class="row">
    
</div>
<div class="view">
    <div class="container">
        <h2>{{$artikel->title}}</h2>
        <p>Author : <b>{{$artikel->author}}</b> | Created At : <b>{{$artikel->created_at}}</b></p>
        {{$artikel->content}}
    </div>
</div>
    
@endsection

@section('footer')
    @include('frontlayout/footer')
@endsection
