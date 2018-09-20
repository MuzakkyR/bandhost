@extends('backlayout.master')

@section('navigasi')
    @include('backlayout/navigasi')
@endsection

@section('content')
    <div class="content">
        <div class="top-content">
            <div class="title col s12">
                <h2>Edit</h2>
            </div>
        </div>
        <div class="form">
            <form method="post" action="/after/article/{{ $article->id }}">
                <input type="text" name="title" value="{{ $article->title }}">
                <textarea name="content" name="content">{{ $article->content }}</textarea>
                <input class="btn" type="submit" name="submit" value="Update">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
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