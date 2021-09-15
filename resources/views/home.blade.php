@include('head')
@include('header')

<body style="background-color: #e32841;">
    <div class="container mt-5 col-12">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-9 col-lg-6">
                <center>
                    <img width="100%" src="{{ asset('img/144ppi/logo_home_1.png') }}"></img>
                </center>
            </div>
        </div>

        <div class="container" style="display: flex; align-items: center; justify-content: center;">
            <div class="mt-5 col-sm-8 col-md-9 col-lg-6" style="margin-bottom: 10%;">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('img/144ppi/slid_home_1.png') }}" alt="image1">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('img/144ppi/slid_home_2.png') }}" alt="image2">
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>

                {{-- <center>
                    <img width="100%" ></img>
                </center> --}}
            </div>
        </div>
    </div>
    @include('login')
    @include('footer')
    @include('validaciones')
</body>

</html>
