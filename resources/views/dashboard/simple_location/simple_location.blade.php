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
                <a class="btn btn-primary" href="/dashboard/manage-location/create">Create Data</a>
            </div>
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List Taman Wisata</h6>
                    </div>
                    <div class="card-body album" style="width: 100%;">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                            @foreach($DataSL as $simple_location)
                            <div class="col">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <p class="card-text">
                                            {{ $simple_location->name_location }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a class="btn btn-success" href="/dashboard/manage-location/edit/{{ $simple_location->id }}">Edit</a>
                                            <a class="btn btn-danger" href="/dashboard/manage-location/delete/{{ $simple_location->id }}">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
    