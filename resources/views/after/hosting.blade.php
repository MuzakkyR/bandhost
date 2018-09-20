@extends('backlayout.master')

@section('navigasi')
    @include('backlayout/navigasi')
@endsection

@section('content')
    <div class="content">
        <div class="top-content">
            <div class="title col s12">
                <h2>Banding Hosting</h2>
            </div>
            @if(Auth::user()->role == "admin")
                <div class="row">
                    <div class="refresh-btn col s12 m3 offset-m9">
                        <a class="waves-effect waves-light btn" href="/after/hosting/refresh">Refresh</a> 
                    </div>
                </div>
            @endif          
        </div>
        <div class="table">
            <table class="responsive-table highlight bordered">
                <thead>
                    <tr>
                        <th>Nama Paket</th>
                        <th>Harga Bulanan</th>
                        <th>Disk Space</th>
                        <th>Bandwidth</th>
                        <th>Database</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th></th>
                    </tr>   
                </thead>
                @foreach ($filhos as $filter)
                    <tr>
                        <td>{{ $filter->packet_name }}</td>
                        <td>Rp. {{ $filter->month_price }}</td>
                        <td>{{ $filter->disk_space }}MB</td>
                        <td>
                            @if ($filter->bandwidth == -1) 
                                unknown
                            @elseif ($filter->bandwidth == null)
                                unlimited 
                            @else 
                                {{ $filter->bandwidth . 'GB' }}
                            @endif                            
                        </td>
                        <td>
                            @if ($filter->database == -1) 
                                unknown
                            @else
                                {{ $filter->database }}
                            @endif
                            @empty($filter->database) unlimited @endempty
                        </td>
                        <td>
                            @if ($filter->email == -1) 
                                unknown
                            @else
                                {{ $filter->email }}
                            @endif
                            @empty($filter->email) unlimited @endempty
                        </td>
                        <td>{{ $filter->brand }}</td>
                        <td><a href="{{ url('after/hosting', $filter->hostingID) }}">Detail</a></td>
                    </tr>
                @endforeach
            </table>
            {!! $filhos->links() !!}
        </div>
        <form action="/after/hosting" method="get" class="form-filter">
            <div class="row">
                <div class="col s6">
                    <fieldset>
                        <legend>Harga</legend>
                        <p>
                            <input class="with-gap" name="price" type="radio" id="price1" value=10000/>
                            <label for="price1">Rp. 0 - Rp. 10.000</label>
                        </p>
                        <p>
                            <input class="with-gap" name="price" type="radio" id="price2" value=20000/>
                            <label for="price2">Rp. 10.001 - Rp. 20.000</label>
                        </p>
                        <p>
                            <input class="with-gap" name="price" type="radio" id="price3" value=30000/>
                            <label for="price3">Rp. 20.001 = Rp. 30.000</label>
                        </p>
                    </fieldset>
                </div>
                <div class="col s6">
                    <fieldset>
                        <legend>Company</legend>
                        @for ($i=0; $i < count($filcom); $i++)
                            @if ($i>0)
                                @if ($filcom[$i] != $filcom[($i - 1)] )
                                    <p>
                                        <input class="filled-in" name="company[]" type="checkbox" id="{{ $filcom[$i] }}" value="{{ $filcom[$i] }}"/>
                                        <label for="{{ $filcom[$i] }}">{{ $filcom[$i] }}</label>
                                    </p>
                                @endif
                            @else
                                <p>
                                    <input class="filled-in" name="company[]" type="checkbox" id="{{ $filcom[$i] }}" value="{{ $filcom[$i] }}"/>
                                    <label for="{{ $filcom[$i] }}">{{ $filcom[$i] }}</label>
                                </p>
                            @endif
                        @endfor
                    </fieldset>
                </div>
            </div>
            <input class="waves-effect waves-light btn" type="submit" name="submit" value="Filter">
        </form>
    </div>
@endsection

@section('footer')
    @include('backlayout/footer')
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $(".dropdown-button").dropdown(); 
        });
    </script>

@endsection