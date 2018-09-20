@extends('backlayout.master')

@section('navigasi')
    @include('backlayout/navigasi')
@endsection

@section('content')
<div class="content">
    <table class="bordered">
        <tr>
            <th>Company</th>
            <td>{{ $tampilkan->brand }}</td>
        </tr>
        <tr>
            <th>Packet Name</th>
            <td>{{ $tampilkan->packet_name }}</td>
        </tr>
        <tr>
            <th>Disk Space</th>
            <td>{{ $tampilkan->disk_space }}</td>
        </tr>
        <tr>
            <th>Bandwidth</th>
            <td>
                @if ($tampilkan->bandwidth == -1) 
                    unknown
                @elseif ($tampilkan->bandwidth == null)
                    unlimited 
                @else 
                    {{ $tampilkan->bandwidth . 'GB' }}
                @endif                            
            </td>
        </tr>
        <tr>
            <th>Database</th>
            <td>
                @if ($tampilkan->database == -1) 
                    unknown
                @else
                    {{ $tampilkan->database }}
                @endif
                @empty($tampilkan->database) unlimited @endempty
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td>
                @if ($tampilkan->email == -1) 
                    unknown
                @else
                    {{ $tampilkan->email }}
                @endif
                @empty($tampilkan->email) unlimited @endempty
            </td>
        </tr>
        <tr>
            <th>Addon Domain</th>
            <td>
                @if ($tampilkan->addon_domain == -1) 
                    unknown
                @else
                    {{ $tampilkan->addon_domain }}
                @endif
                @empty($tampilkan->addon_domain) unlimited @endempty
            </td>
        </tr>
        <tr>
            <th>Parked Domain</th>
            <td>
                @if ($tampilkan->parked_domain == -1) 
                    unknown
                @else
                    {{ $tampilkan->parked_domain }}
                @endif
                @empty($tampilkan->parked_domain) unlimited @endempty
            </td>
        </tr>
        <tr>
            <th>Subdomain</th>
            <td>
                @if ($tampilkan->subdomain == -1) 
                    unknown
                @else
                    {{ $tampilkan->subdomain }}
                @endif
                @empty($tampilkan->subdomain) unlimited @endempty
            </td>
        </tr>
        <tr>
            <th>Other</th>
            <td>
                {{ $tampilkan->other }}
            </td>
        </tr>
        <tr>
            <th>Month Price</th>
            <td>{{ $tampilkan->month_price }}</td>
        </tr>
    </table>
</div>
@endsection

@section('footer')
    @include('backlayout/footer')
@endsection