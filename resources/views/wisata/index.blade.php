@extends('layouts/main')

@section('title', 'Taman Wisata')

@section('content')
    <style>
        #banner .jumbotron {
            background-image: url('https://www.rentalmobilbali.net/wp-content/uploads/2016/05/10-Tempat-Wisata-Favorit-Wisatawan-Indonesia-Di-Bali-Facebook.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: 100%;
            height: 500px;
            box-shadow: 3px 0px 10px rgba(25,25,25, .5);
            padding-top: 0;
            padding-bottom: 0;
        }

        #banner .jumbotron .container-fluid {
            width: 100%;
            height: 100%;
            background-color: rgba(25,25,25,0.75);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #banner .wrapper-box {
            color: #fff;
            text-align: center;
        }

        #content-wisata .album {
            padding: 0 5%;
        }

        .bg-image-thumb {
            height: 225px;
            background-color: rgb(85, 89, 92);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        a {
            text-decoration: none;
            color: unset;
        }

        a:hover {
            color: unset;
        }

        .links-page {
            padding: 2.5% 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .links-page nav {
            width: auto;
        }

        .links-page svg {
            width: 2%;
        }

        .links-page nav div:nth-child(2) {
            display: none;
        }
    </style>
    <div id="banner">
        <div class="jumbotron jumbotron-fluid" style="margin: 0;">
            <div class="container-fluid">
                <div class="wrapper-box">
                    <h1 class="display-4">Welcome to our website</h1>
                    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="content-wisata">
        <div class="album py-5 bg-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Rekomendasi tempat wisata</h2>
                    </div>
                </div>
                <div class="row" style="padding: 2.5% 10%">
                    <form class="col-md-12 d-flex justify-center d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="row input-group mb-3">
                            <input id="query" class="col-11" type="text" name="query" style="border: 1px solid #dedede !important;" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="col-1 input-group-append">
                                <button name="normal-search" class="btn btn-primary" type="submit" id="search-btn" value="normal-search">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row mb-12">
                            <div class="col-12 card py-4">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="row">
                                            <label for="rating" class="form-label col-1">Rating : </label>
                                            <div class="col-11">
                                                <select id="rating" name="rating" class="form-control w-100">
                                                    <option value="">default</option>
                                                    <option value="5">sangat bagus</option>
                                                    <option value="4">bagus</option>
                                                    <option value="3">normal</option>
                                                    <option value="2">tidak bagus</option>
                                                    <option value="1.9">sangat tidak bagus</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-12 mb-2">
                                        <div class="row">
                                            <label for="location" class="form-label col-1">Location : </label>
                                            <div class="col-11">
                                                <select id="location" name="location" class="form-control w-100">
                                                    <option value="{{ $LocationVal }}">default</option>
                                                    @foreach($DataSL as $simple_location)
                                                        <option value="{{ $simple_location->name_location }}">{{ $simple_location->name_location }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="col-12 mb-2">
                                        <div class="row">
                                            <label for="price-min" class="form-label col-1">price min : </label>
                                            <div class="col-11">
                                                <input id="price-min" class="form-control w-100" id="price-min" type="numbv" name="price-min" placeholder="price min">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <div class="row">
                                            <label for="price-max" class="form-label col-1">price max : </label>
                                            <div class="col-11">
                                                <input id="price-max" class="form-control w-100" id="price-max" type="number" name="price-max" placeholder="price max">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <div class="row">
                                            <label for="jarak" class="form-label col-2">Jarak Kilometer: </label>
                                            <div class="col">
                                                <input id="jarak-from" class="form-control w-100" id="jarak-from" type="numbv" name="jarak-from" placeholder="jarak-from Km">
                                            </div>
                                            <div class="col">
                                                <input id="jarak-to" class="form-control w-100" id="jarak-to" type="numbv" name="jarak-to" placeholder="jarak-to Km">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <input type="text" value="preference" name="preverence" style="display:none;">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <label for="location" class="form-label col-2">Location : </label>
                                                    <div class="col-10">
                                                        <select id="location" name="location" class="form-control w-100">
                                                            <option value="">default</option>
                                                            @foreach($DataSL as $simple_location)
                                                                <option value="{{ $simple_location->name_location }}">{{ $simple_location->name_location }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button name="preverence" class="btn btn-primary w-100" type="submit" id="preverence-btn" value="preverence">
                                            Set Preverence
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- <form class="col-12">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <input type="text" value="preference" name="preverence" style="display:none;">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <label for="location" class="form-label col-2">Location : </label>
                                            <div class="col-10">
                                                <select id="location" name="location" class="form-control w-100">
                                                    <option value="">default</option>
                                                    @foreach($DataSL as $simple_location)
                                                        <option value="{{ $simple_location->name_location }}">{{ $simple_location->name_location }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button name="preverence" class="btn btn-primary w-100" type="submit" id="preverence-btn" value="preverence">
                                    Set Preverence
                                </button>
                            </div>
                        </div>
                    </form> -->
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($data_taman as $dt)
                        <div class="col">
                            <a href="/tempat-wisata/detail/{{ $dt->id }}">
                                <div class="card shadow-sm">
                                    <!-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                        <title>Placeholder</title>
                                        <rect width="100%" height="100%" fill="#55595c"></rect>
                                        <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                                    </svg> -->
                                    @if( $dt->thumbnail == NULL )
                                        <div class="bd-placeholder-img card-img-top bg-image-thumb"></div>
                                    @else
                                        <div class="bd-placeholder-img card-img-top bg-image-thumb"
                                            style="background-image: url('{{ asset('storage/images/' . $dt->thumbnail) }}')"
                                        ></div>
                                    @endif
                                    <div class="card-body">
                                        <div class="card-text">
                                            <h4>{{ $dt->title }}</h4>
                                        </div>
                                        <p class="card-text">
                                            {{ $dt->excerpt }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">Rp. {{ $dt->price }}</small>
                                            @if($dt->rating == 5) <small class="text-muted">sangat bagus</small>
                                            @elseif($dt->rating >= 4) <small class="text-muted">bagus</small>
                                            @elseif($dt->rating >= 3) <small class="text-muted">normal</small>
                                            @elseif($dt->rating >= 2) <small class="text-muted">tidak bagus</small>
                                            @elseif($dt->rating >= 1) <small class="text-muted">sangat tidak bagus</small>
                                            @else <small class="text-muted"></small>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">{{ $dt->simple_location }} - {{ $dt->jarak }} KM</small>
                                            <small class="text-muted">{{ $dt->created_at }}</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="row links-page">
                    {{ $data_taman->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        const urlSearchParams = new URLSearchParams(window.location.search);
        const QueryParams = Object.fromEntries(urlSearchParams.entries());

        if ( QueryParams != {} ) {
            console.log(QueryParams)
            $("#query").val(QueryParams['query'])
            $("#price-min").val(QueryParams['price-min'])
            $("#price-max").val(QueryParams['price-max'])
            $("#rating").val(QueryParams['rating'])
            $("#location").val(QueryParams['location'])
        }


        const getCurrentLocation = () => {
            var getPosition = {
                enableHighAccuracy: false,
                timeout: 9000,
                maximumAge: 0
            };
            
            // Your Current Position Here
            function success(gotPosition) {
                var uLat = gotPosition.coords.latitude;
                var uLon = gotPosition.coords.longitude;
                console.log(`${uLat}`, `${uLon}`);
            };
            
            function error(err) {
                console.warn(`ERROR(${err.code}): ${err.message}`);
            };
            
            navigator.geolocation.getCurrentPosition(success, error, getPosition);
        }

        getCurrentLocation()
    </script>
@endsection
    