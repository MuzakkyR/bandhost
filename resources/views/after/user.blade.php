@extends('backlayout.master')

@section('navigasi')
    @include('backlayout/navigasi')
@endsection

@section('content')
    <div class="content">
        <div class="top-content">
            <div class="title col s12">
                <h2>Profil Setting</h2>
            </div>             
        </div>
        <div class="setting">
            <form action="/after/user/refresh" method="post">
                <table>
                    @foreach ($profil as $profils)
                        <tr>
                            <th>Fullname</th>
                            @if ( ($profils->fullname) == null)
                            <td><input type="text" name="fullname" value="" placeholder="Nama anda belum diisi"></td>
                            @else
                            <td>{{ $profils->fullname }}</td>
                            @endif
                        </tr>
                        <tr>
                            <th>Current Username</th>
                            <td>{{ $profils->username }}</td>
                        </tr>
                        <tr>
                            <th>New Username</th>
                            <td><input type="text" name="username" value="" placeholder="Minimum 6 char"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $profils->email }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{ $profils->role }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2"><input class="btn" type="submit" name="submit" value="save"></td>
                    </tr>
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                </table>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    @include('backlayout/footer')
@endsection
