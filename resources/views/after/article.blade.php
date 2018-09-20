@extends('backlayout.master')

@section('navigasi')
    @include('backlayout/navigasi')
@endsection

@section('content')
    <div class="content">
        <div class="top-content">
            <div class="row">
                <div class="title col s12">
                    <h2>Article</h2>
                </div>
                <div class="col s1 offset-s10">
                    <a href="/after/article/create" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
                </div>
            </div>
        </div>
        <div class="table">
            <table class="responsive-table highlight bordered">
                <tr>
                    <th>Title</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th colspan="3">Action</th>
                </tr>
                @foreach ($article as $artikel)
                <tr>              
                    <td>{{ $artikel->title }}</td>
                    <td>{{ $artikel->created_at }}</td>
                    <td>{{ $artikel->updated_at }}</td>
                    <td><a class="btn" href="/after/article/{{$artikel->id}}/edit">Edit</a></td>
                    <td>
                        <form action="/after/article/{{$artikel->id}}" method="post">
                            <input class="btn" type="submit" name="submit" value="Delete">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                        </form>
                    </td>
                    <td><a class="btn" href="/blog/{{$artikel->slug}}">View</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

@section('footer')
    @include('backlayout/footer')
@endsection