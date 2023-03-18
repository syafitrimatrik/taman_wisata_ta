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
            padding: 0;
        }

        #banner .jumbotron .container-fluid {
            width: 100%;
            height: 100%;
            background-color: rgba(25,25,25,0.25);
            display: flex;
            justify-content: flex-start;
            align-items: flex-end;
            padding: 0;
        }

        #banner .wrapper-box {
            width: 100%;
            padding: 10px 20px;
            background-color: rgba(1,1,1, 0.8);
            color: #fff;
            text-align: left;
        }

        #content-wisata .album {
            padding: 0 5%;
        }

        .bg-image-thumb {
            height: 225px;
            background-color: rgb(85, 89, 92);
        }

        a {
            text-decoration: none;
            color: unset;
        }

        a:hover {
            color: unset;
        }

        #slider-detail .image-box {
            padding: 0 10px;
        }

        #slider-detail .image-bg {
            /* width: 100%; */
            height: 100px;
            background-color: #dedede;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            cursor: pointer;
        }

        #slider-detail .slick-arrow {
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
            cursor: pointer;
        }

        #slider-detail .slick-prev  {
            left: -5px;
        }

        #slider-detail .slick-next  {
            right: -15px;
        }

        #fasilitas-wisata {
            padding: 2.5%;
        }

        #fasilitas-wisata ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            /* grid-template-rows: 50%; */
            grid-template-columns: 1fr 1fr;
            /* grid-auto-rows: 50%; */
        }

        #fasilitas-wisata ul li {
            
        }

        textarea {
            width: 100%;
            height: 150px;
        }

        iframe {
            width: 100%;
        }

        .image-box-comment {
            width: 75px;
            height: 75px;
            background-color: #dedede;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            border-radius: 5px;
        }
        
        #content-slider, #description {
            padding: 0 2.5%;
        }

        #content-slider .card-body {
            padding: 2.5% 5%;
        }
    </style>
    <div id="banner">
        <div class="jumbotron jumbotron-fluid"
            style="background-image: url('{{ asset('storage/images/' . $data_detail->thumbnail) }}')"
        >
            <div class="container-fluid">
                <div class="wrapper-box">
                    <h2>{{ $data_detail->title }}</h2>
                    <p>{{ $data_detail->excerpt }}</p>
                </div>
            </div>
        </div>
    </div>

    <div id="content-slider" class="container-fluid">
        <!-- <div class="row">
            <div class="col-md-12 p-3 text-center">
                <h2>Rekomendasi tempat wisata</h2>
            </div>
        </div> -->
        <div class="row">
            @if( Session::get('users') != NULL ) 
                @if( count($data_favourites) > 0 )
                    <div class="col-md-12 p-3 text-center">
                        <a class="btn btn-danger" href="/remove-to-favourites/{{ $data_detail->id }}">Remove From Favourites</a>
                    </div>
                @else
                    <div class="col-md-12 p-3 text-center">
                        <a class="btn btn-success" href="/add-to-favourites/{{ $data_detail->id }}">Add To Favourites</a>
                    </div>
                @endif
            @else
                <div class="col-md-12 p-3 text-center">
                    <!-- <a class="btn btn-success" href="/login">Login to add favorite..</a> -->
                </div>
            @endif
        </div>
        <div class="row card shadow mb-4 slider-box">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-center">Preview Images</h6>
            </div>
            <div class="card-body">
                @if(count($data_images) == 0)
                    no images preview
                @else
                    <div id="slider-detail" class="col-md-12">
                        <div class="image-box">
                            <div class="image-bg" style="background-image: url('{{ asset('storage/images/' . $data_detail->thumbnail) }}')"></div>
                        </div>
                    @foreach($data_images as $images)
                        @if($images->type != 'imageslink')
                            <div class="image-box">
                                <div class="image-bg" style="background-image: url('{{ asset('storage/images/' . $images->name_image) }}')"></div>
                            </div>
                        @else
                            <div class="image-box">
                                <div class="image-bg" style="background-image: url('{{ $images->name_image }}')"></div>
                            </div>
                        @endif
                    @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <section id="description" class="container-fluid">
        <div class="row card bg-light text-black shadow">
            <div class="card-body col-md-12">
                <h4>Description : </h4>
                <div class="text-black-50 small">
                {{ $data_detail->description }}
                </div>
            </div>

            <div class="card-body col-md-12">
                <div class="mb-3">
                    <h4>Rating :</h4> <span style="text-transform: uppercase;">{{ $data_detail->rating }}</span>
                </div>
                <div class="mb-3">
                    <h4>Price :</h4> <span>Rp. {{ $data_detail->price }}</span>
                </div>
                <h4>Fasilitas</h4>
                <div class="text-black-50 small" id="fasilitas-wisata">
                    <ul>
                        @foreach($data_fasilitas as $value)
                        <li>
                            <span>
                                <i class="{{ $value->name_icon }}"></i>
                            </span>
                            <span>{{ $value->title_fasilitas }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            <div class="card-body col-md-12">
                <div class="col-md-12">
                    <h4 class="">Lokasi : </h4>
                </div>
                <div class="col-md-12 mb-2">
                    <small>Latitude ( {{ $data_detail->latitude }} )</small>
                    <small>Longitude ( {{ $data_detail->longitude }} )</small>
                </div>
                <div class="col-md-12 mb-3" id="lokasi-wisata">
                    {!! htmlspecialchars_decode($data_detail->maps) !!}
                </div>
            </div>
        </div>
    </section>

    <div id="comment" class="container-fluid" style="padding: 2.5%;">
        <div class="row card shadow mb-4">
            <div class="card-header py-3 col-md-12">
                <h6 class="m-0 font-weight-bold text-primary"><h3>Comment here : </h3></h6>
            </div>
            <div class="card-body col-md-12">
                <!-- Add Comments Here -->
                @if( Session::get('users') != NULL )
                    <form class="row" action="/comments/{{ $data_detail->id }}" method="post">
                        @csrf
                        <input name="users_id" value="{{ Session::get('users')->id }}" style="display: none;" />
                        <input name="taman_wisata_id" value="{{ $data_detail->id }}" style="display: none;" />
                        <div class="form-group">
                            <textarea type="text" name="comment" class="form-control" id="comment" placeholder="input your comment here.."></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit" id="button-comment">Submit Comment</button>
                        </div>
                    </form>
                @else
                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-success" href="/login">Login to comment..</a>
                        </div>
                    </div>
                @endif

                <!-- List Comments Here -->
                <div class="col-md-12 wrapper-list-comment" style="padding: 1.5% 2.5% 3.5%;">
                    <div class="title mb-3">
                        <h5>List Comment : </h5>
                    </div>
                    @for($i = 0; $i < count($data_comment); $i++)
                        <div class="card mb-4 py-3 border-left-info">
                            <div class="card-body">
                                <div class="col-md-12 persons-box mb-3" style="display: flex;">
                                    <div class="image-box-comment mr-3" style="background-image: url('{{ asset('storage/profile/' . $data_comment[$i]->images_profile) }}')"></div>
                                    <div class="profile-box">
                                        <h5>{{ $data_comment[$i]->username }}</h5>
                                        <small>{{ $data_comment[$i]->location }}</small>
                                    </div>
                                </div>
                                <div class="col-md-12 comment-box">
                                    {{ $data_comment[$i]->comment }}
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#slider-detail').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            centerPadding: '50px',
            prevArrow: `<i class="slick-prev fas fa-angle-left"></i>`,
            nextArrow: `<i class="slick-next fas fa-angle-right"></i>`,
            responsive: [
                {
                    breakpoint: 1080,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 475,
                    settings: {
                        slidesToShow: 1
                    }
                },
            ]
        });

        $('.image-bg').on('click', (e) => {
            e.preventDefault();
            // e.target.getAttribute('style')
            $('#banner .jumbotron').attr('style', `${ e.target.getAttribute('style') }`)
        })
    </script>
@endsection
    
