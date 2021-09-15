@include('head')
@include('header')

<body>
    <div class="container">
        <div class="container cstm__container_second">
            <div class="col-sm-12 col-md-12 col-lg-12 cstm__container__slide">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img width="100%" src="{{ asset('img/144ppi/logo_home_1.png') }}"></img>
                        </div>
                        <div class="carousel-item">
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
            </div>
        </div>
    </div>
    @include('login')
    @include('footer')
    @include('validaciones')
</body>

</html>
