@extends('backlayout.master')

@section('navigasi')
    @include('backlayout/navigasi')
@endsection

@section('content')
    <div class="content">
        <div class="top-content">
            <div class="title col s12">
                <h2>Dashboard</h2>
            </div>
        </div>
        <div class="">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <div class="collapsible-header"><i class="material-icons">whatshot</i>Domain</div>
                    <div class="collapsible-body">
                        <span>Domain adalah nama yang digunakan untuk mengidentifikasikan website seperti namasaya.com dan sebagainya.</span>
                        <ul class="collapsible" data-collapsible="accordion">
                            <li>
                                <div class="collapsible-header"><i class="material-icons">whatshot</i>Registrasi Domain</div>
                                <div class="collapsible-body"><span>Registrasi Domain adalah pendaftaran sebuah nama domain yang kita inginkan pada penyedia layanan agar dapat diakses secara publik.</span></div>
                            </li>
                            <li>
                                <div class="collapsible-header"><i class="material-icons">whatshot</i>Transfer Domain</div>
                                <div class="collapsible-body"><span>Transfer Domain adalah memindahkan domain yang sudah dimiliki dari penyedia layanan yang lama ke penyedia layanan yang baru.</span></div>
                            </li>
                            <li>
                                <div class="collapsible-header"><i class="material-icons">whatshot</i>Renewal Domain</div>
                                <div class="collapsible-body"><span>Renewal Domain adalah pembaruan jangka waktu aktif dalam menggunakan domain. Domain yang sudah lewat dari jangka waktu aktif dan tidak di perbarui maka akan hilan dan tidak dapat diakses oleh publik lagi.</span></div>
                            </li>
                            <li>
                                <div class="collapsible-header"><i class="material-icons">whatshot</i>Top Level Domain</div>
                                <div class="collapsible-body">
                                    <span>Top level domain adalah bagian akhir atau belakang dari sebuah domain, misalnya www.namasaya.com maka top level domainnya adalah .com. Top level domain terbagi menjadi 2 macam yaitu : Generic top level domain yang bersifat umum dan Country code level domain yang berdasarkan pada kode masing-masing negara.</span>
                                    <ul class="collapsible" data-collapsible="accordion">
                                        <li>
                                            <div class="collapsible-header"><i class="material-icons">whatshot</i>COM</div>
                                            <div class="collapsible-body"><span>Ekstensi .com merupakan kependekan dari commercial dan awalnya digunakan untuk website yang berbasiskan komersil</span></div>
                                        </li>
                                        <li>
                                            <div class="collapsible-header"><i class="material-icons">whatshot</i>NET</div>
                                            <div class="collapsible-body"><span>.net merupakan kependekan dari network dan ditujukan untuk penggunaan website berbasiskan jaringan dan layanan internet.</span></div>
                                        </li>
                                        <li>
                                            <div class="collapsible-header"><i class="material-icons">whatshot</i>ORG</div>
                                            <div class="collapsible-body"><span>.org merupakan kependekan dari organization dan ditujukan untuk penggunaan website sebuah organisasi maupun lembaga</span></div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">whatshot</i>Hosting</div>
                    <div class="collapsible-body"><span>Hosting adalah suatu layanan yang menyediakan wadah atau tempat di internet agar website dapat diakses secara oleh publik</span></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">whatshot</i>Bandhwidth</div>
                    <div class="collapsible-body"><span>Bandhwidth adalah nilai transfer data dalam satuan bit/detik</span></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">whatshot</i>Virtual Private Server</div>
                    <div class="collapsible-body"><span>Virtual Private Server (VPS) adalah server virtual yang digunakan oleh satu website saja</span></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">whatshot</i>Database</div>
                    <div class="collapsible-body"><span>Database adalah tempat menyimpan data</span></div>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('footer')
    @include('backlayout/footer')
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.collapsible').collapsible();
        });
    </script>
@endsection