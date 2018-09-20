@extends('backlayout.master')

@section('navigasi')
    @include('backlayout/navigasi')
@endsection

@section('content')
    <div class="content">
        <div class="top-content">
            <div class="title col s12">
                <h2>Member Setting</h2>
            </div>
        </div>
        <div class="table">
            <form action="/after/access/refresh" method="get">
                <table class="responsive-table highlight bordered">
                    <tr>
                        <th>username</th>
                        <th>email</th>
                        <th>role</th>
                        <th>Join Date</th>
                        <th></th>
                    </tr>
                    @foreach ( $userlist as $user )
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->created_at }}</td>
                        @if($user->role == "admin")
                            <td><input class="btn disabled" type="submit" name="submit" value="Make Admin"></td>
                        @else
                            <input type="hidden" name="username" value="{{ $user->username }}">
                            <td><input class="btn" type="submit" name="submit" value="Make Admin"></td>
                        @endif
                    </tr>
                    @endforeach
                </table>
            </form>
        </div>
  

@endsection

@section('footer')
    @include('backlayout/footer')
@endsection