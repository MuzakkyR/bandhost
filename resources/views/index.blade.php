@extends('frontlayout.master')

@section('page-css')
    <link rel="stylesheet" type="text/css" href="/css/index.css">
@endsection

@section('navigasi')
    @include('frontlayout/navigasi')
@endsection

@section('parallax-header')
    <div class="preloader-background">
        <div class="preloader-wrapper big active">
            <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="parallax-container" >
        <div class="parallax"><img src="img/wall.jpg"></div>
        <div class="parallax-content-wrapper">
            <div class="parallax-content center white-text parallax-header">
                <div class="divider"></div>
                <div class="section">
                    <h1>EASY TO COMPARE</h1>
                    <p>Get Started Now<p>
                </div>

                <div class="section">
                    @if (Auth::guest())
                        <a href="{{ url('/register') }}" class="waves-effect waves-light btn">Register</a>          
                        <a href="{{ url('/login') }}" class="waves-effect waves-light btn">Login</a>
                    @else
                        <a href="{{ url('/after/user') }}" class="waves-effect waves-light btn">Dashboard</a>
                    @endif
                </div>
                <div class="divider"></div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div id="Domain" class="scrollspy">
        <div class="row">
            <div class="domain-img col s12 l6">
                <img src="img/domain.png" alt="">
            </div>
            <div class="domain-desc col s12 l6">
                <h4>Domain</h4>
                <p>Domain adalah nama yang digunakan untuk mengindentifikasikan sebuah website. Nama domain bersifat 
                unik, sehingga tidak boleh sama antara satu domain dengan yang lainnya ( Wahana Komputer, 2017). 
                TLD adalah domain yang berada pada posisi paling belakang dari alamat website, seperti .com, .xyz dan masih banyak lagi.</p>
            </div>
        </div>
    </div>
    <div id="Hosting" class="scrollspy">
        <div class="row">
            <div class="hosting-desc col s12 l6">
                <h4>Hosting</h4>
                <p>Layanan web hosting adalah suatu layanan yang menyediakan layanan hosting internet supaya website 
                    dapat diakses melalui jaringan internet ( Wahana Komputer, 2017: 2). Harga web hosting bervariasi 
                    tergantung dari fitur apa yang ditawarkan oleh penyedia jasa layanan.</p>
            </div>
            <div class="hosting-img col s12 l6">
                <img src="img/hosting.png" alt="">
            </div>
        </div>
    </div>
    <div id="Feature" class="hide-on-small-only parallax-container scrollspy">
        <div class="parallax"><img src="img/wall.jpg"></div>
        <div class="parallax-content-wrapper">
            <div class="row">
                <div class="feature col s4">
                    <i class="large material-icons">blur_circular</i>
                    <h5>Harga Domain</h5>
                    <p>Membandingkan harga domain berdasarkan ekstensinya dari berbagai penyedia jasa layanan.</p>
                </div>
                <div class="feature col s4">
                    <i class="large material-icons">cloud</i>
                    <h5>Harga Hosting</h5>
                    <p>Membandingkan harga hosting dari berbagai penyedia jasa layanan.</p>
                </div>
                <div class="feature col s4">
                    <i class="large material-icons">build</i>
                    <h5>Fitur Hosting</h5>
                    <p>Membandingkan fitur yang didapat pada kisaran harga hosting yang sama.</p>
                </div>
            </div>
        </div>
    </div>
    <div id="Feature" class="hide-on-med-and-up parallax-container scrollspy">
        <div class="parallax"><img src="img/wall.jpg"></div>
        <div class="parallax-content-wrapper">
            <div class="row">
                <div class="feature featuremobile col s4">
                    <i class="large material-icons">blur_circular</i>
                    <h5 style="font-size:140%!important;">Banding Harga Domain</h5>
                </div>
                <div class="feature featuremobile col s4">
                    <i class="large material-icons">cloud</i>
                    <h5 style="font-size:140%!important;">Banding Harga Hosting</h5>
                </div>
                <div class="feature featuremobile col s4">
                    <i class="large material-icons">build</i>
                    <h5 style="font-size:140%!important;">Banding Fitur Hosting</h5>
                </div>
            </div>
        </div>
    </div>
    <fieldset id="Blog" class="scrollspy">
        <legend>Blog</legend>
        <div class="row">
            @foreach ($artikel as $article)
            <div class="col s12 m6 l3">
                <div class="card">
                    <div class="card-image">
                        <img src="img/wall.jpg">
                        <a href="/blog/{{$article->slug}}" class="card-title">{{$article->title}}</a>
                    </div>
                    <div class="card-content">
                        <p>{{str_limit($article->content, 100)}}</p>
                    </div>
                    <div class="card-action">
                        <b>Author : {{$article->author}}</b>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {!! $artikel->links() !!}
    </fieldset>
@endsection

@section('footer')
    @include('frontlayout/footer')
@endsection

@section('javascript')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(){
            $('.preloader-background').delay(500).fadeOut('fast');
            
            $('.preloader-wrapper')
                .delay(1000)
                .fadeOut();
        });
        $(document).ready(function() {
            $('.parallax').parallax();
            
        });  
        $(document).ready(function(){
            $('.scrollspy').scrollSpy({
                scrollOffset:60
            });
        });
    </script>
@endsection