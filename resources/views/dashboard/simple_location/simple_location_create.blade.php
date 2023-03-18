@extends('layouts/admin/dashboard')

@section('title', 'Dashboard')

@section('content')
    <style>
        .bg-image-thumb {
            height: 175px;
            background-color: rgb(85, 89, 92);
        }

        #images-preview .mb-3,
        #fasilitas-preview .mb-3 {
            display: flex;
        }

        #maps-show {
            padding: 25px 10px;
        }
        
        iframe {
            width: 100%;
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
                <a class="btn btn-primary" href="/dashboard/manage-location">Back</a>
            </div>
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Create Data For Taman Wisata</h6>
                    </div>
                    <div class="card-body" style="width: 100%;">
                    <form class="users" action="/dashboard/manage-location/create" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="name_location" class="form-label">name location</label>
                                <input type="text" name="name_location" class="form-control" id="name_location" placeholder="input your name location here..">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Create Data
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
    