@extends('backlayout.master')

@section('navigasi')
    @include('backlayout/navigasi')
@endsection

@section('content')
    <div class="content">
        <div class="top-content">
            <div class="title col s12">
                <h2>Create</h2>
            </div>
        </div>
        <div class="form">
            <form method="post" action="/after/article">
                <input type="text" name="title" placeholder="Title">
                <textarea rows="8" cols="40" name="content" id="content"></textarea>
                <input class="btn" type="submit" name="submit" value="create">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection

@section('footer')
    @include('backlayout/footer')
@endsection

@section('js')
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script>CKEDITOR.replace('content');</script>
@endsection