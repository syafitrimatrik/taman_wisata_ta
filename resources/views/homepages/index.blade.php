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
    </style>
    <div id="banner">
        <div class="jumbotron jumbotron-fluid">
            <div class="container-fluid">
                <div class="wrapper-box">
                    <h1 class="display-4">Welcome to our website</h1>
                    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="content-wisata">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Rekomendasi tempat wisata</h2>
            </div>
        </div>
        <div class="album py-5 bg-light">
            <div class="container-fluid">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @for($i = 0; $i < count($data_taman); $i++)
                    <div class="col">
                        <a href="/tempat-wisata/detail/{{ $data_taman[$i]->id }}">
                            <div class="card shadow-sm">
                                <!-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#55595c"></rect>
                                    <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                                </svg> -->
                                @if( $data_taman[$i]->thumbnail == NULL )
                                    <div class="bd-placeholder-img card-img-top bg-image-thumb"></div>
                                @else
                                    <div class="bd-placeholder-img card-img-top bg-image-thumb"
                                        style="background-image: url('{{ asset('storage/images/' . $data_taman[$i]->thumbnail) }}')"
                                    ></div>
                                @endif
                                <div class="card-body">
                                    <div class="card-text">
                                        <h4>{{ $data_taman[$i]->title }}</h4>
                                    </div>
                                    <p class="card-text">
                                        {{ $data_taman[$i]->excerpt }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">Rp. {{ $data_taman[$i]->price }}</small>
                                        @if($data_taman[$i]->rating == 5) <small class="text-muted">sangat bagus</small>
                                        @elseif($data_taman[$i]->rating >= 4) <small class="text-muted">bagus</small>
                                        @elseif($data_taman[$i]->rating >= 3) <small class="text-muted">normal</small>
                                        @elseif($data_taman[$i]->rating >= 2) <small class="text-muted">tidak bagus</small>
                                        @elseif($data_taman[$i]->rating >= 1) <small class="text-muted">sangat tidak bagus</small>
                                        @else <small class="text-muted"></small>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">{{ $data_taman[$i]->simple_location }} - {{ $data_taman[$i]->jarak }} KM</small>
                                            <!-- <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div> -->
                                        <small class="text-muted">{{ $data_taman[$i]->created_at }}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endfor
            </div>
            </div>
        </div>
    </div>

    <!-- <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-3 text-center">
                <h2>Rekomendasi tempat wisata</h2>
            </div>
        </div>
    </div> -->
@endsection
    