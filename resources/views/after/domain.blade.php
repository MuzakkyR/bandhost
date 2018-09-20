@extends('backlayout.master')

@section('navigasi')
    @include('backlayout/navigasi')
@endsection

@section('content')
    <div class="content">
        <div class="top-content">
            <div class="title col s12">
                <h2>Banding Domain</h2>
            </div>
            @if(Auth::user()->role == "admin")
                <div class="row">
                    <div class="refresh-btn col s12 m3 offset-m9">
                        <a class="waves-effect waves-light btn" href="/after/domain/refresh">Refresh</a> 
                    </div>
                </div>
            @endif              
        </div>
        <div class="table hide-on-med-and-down">
            <table id="table_domain" class="responsive-table highlight bordered">
                <thead>
                    <th>Ekstensi</th>
                    <th>Harga Registrasi</th>
                    <th>Harga Transfer</th>
                    <th>Harga Renewal</th>
                    <th>Company</th>
                    <th>Last Update</th>
                </thead>
                @foreach ($fildom as $filter)
                <tr>
                    <td>{{ $filter->domain_name }}</td>
                    <td>{{ $filter->register_price }}</td>
                    <td>{{ $filter->transfer_price }}</td>
                    <td>{{ $filter->renewal_price }}</td>
                    <td>{{ $filter->brand }}</td>
                    <td>{{ $filter->updated_at }}</td>                
                </tr>
                @endforeach
            </table>

            {!! $fildom->links() !!}
        </div>
        <div class="hide-on-large-only">
            <div class="row">
                @foreach ($fildom as $filter)
                <div class="col s12 m6">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">{{ $filter->brand }} | {{ $filter->domain_name }}</span>
                            <p>Register Price : {{ $filter->register_price }}</p>
                            <p>Transfer Price : {{ $filter->transfer_price }}</p>
                            <p>Renewal Price : {{ $filter->renewal_price }}</p>
                        </div>
                        <div class="card-action">
                            <p><b>Last Updated</b> : {{ $filter->updated_at }}</p>
                        </div>
                    </div>
                </div>
                @endforeach

             {!! $fildom->links() !!}   
            </div>
        </div>
        <form action="/after/domain" method="get" class="form-filter">
            <div class="row">
                <div class="col s6">
                    <fieldset>
                        <legend>Ekstensi</legend>
                         @for ($i=0; $i < count($fileks); $i++)
                            @if ($i>0)
                                @if ($fileks[$i] != $fileks[($i - 1)] )
                                    <p>
                                        <input class="with-gap" name="ekstensi" type="radio" id="{{ $fileks[$i] }}" value="{{ $fileks[$i] }}"/>
                                        <label for="{{ $fileks[$i] }}">{{ $fileks[$i] }}</label>
                                    </p>
                                @endif
                            @else
                                <p>
                                    <input class="with-gap" name="ekstensi" type="radio" id="{{ $fileks[$i] }}" value="{{ $fileks[$i] }}"/>
                                    <label for="{{ $fileks[$i] }}">{{ $fileks[$i] }}</label>
                                </p>
                            @endif
                        @endfor
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
   <script type="javascript">
        $(document).ready(function() {

        });
    </script>
@endsection