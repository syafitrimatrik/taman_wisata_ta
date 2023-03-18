@extends('layouts/admin/dashboard')

@section('title', 'Dashboard')

@section('content')
    <style>
        .bg-image-thumb {
            height: 175px;
            background-color: rgb(85, 89, 92);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
    </style>
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-3 text-center">
                <h2>Rekomendasi tempat wisata here</h2>
            </div>
        </div>
    </div>

    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-2">
                <a class="btn btn-primary" href="/dashboard/taman-wisata/create">Create Data</a>
            </div>
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List Taman Wisata</h6>
                    </div>
                    <div class="card-body album" style="width: 100%;">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        @for($i = 0; $i < count($data_taman); $i++)
                            <div class="col">
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
                                            <a href="/tempat-wisata/detail/{{ $data_taman[$i]->id }}">
                                                <h4>{{ $data_taman[$i]->title }}</h4>
                                            </a>
                                        </div>
                                        <p class="card-text">
                                        {{ $data_taman[$i]->excerpt }}
                                        </p>
                                        <div class="mb-2">
                                            <small class="text-muted">{{ $data_taman[$i]->created_at }}</small>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                                <!-- <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                                </div> -->
                                            <a class="btn btn-success" href="/dashboard/taman-wisata/edit/{{ $data_taman[$i]->id }}">Edit</a>
                                            <a class="btn btn-danger" href="/dashboard/taman-wisata/delete/{{ $data_taman[$i]->id }}">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
    