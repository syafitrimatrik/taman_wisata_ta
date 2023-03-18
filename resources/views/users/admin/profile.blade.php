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

        #image-profile {
            width: 150px;
            height: 150px;
            background-color: #dedede;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            border-radius: 10px;
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
                <a class="btn btn-primary" href="/dashboard/profile/edit/{{ Session::get('users')->id }}">Edit Data</a>
            </div>
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List Taman Wisata</h6>
                    </div>
                    <div class="card-body album" style="width: 100%;">
                        <div id="image-profile" style="background-image: url('{{ asset( 'storage/profile/' . Session::get('profile')->images_profile ) }}')"></div>
                        <div class="mt-3">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">fullname</label>
                                    <input disabled="true" value="{{ Session::get('profile')->fullname }}" type="text" name="fullname" class="form-control" id="fullname" placeholder="input your fullname here..">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="location" class="form-label">location</label>
                                    <input disabled="true" value="{{ Session::get('profile')->location }}" type="text" name="location" class="form-control" id="location" placeholder="input your location here..">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="email" class="form-label">email</label>
                                    <input disabled="true" value="{{ Session::get('users')->email }}" type="text" name="email" class="form-control" id="fullname" placeholder="input your fullname here..">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="description" class="form-label">description</label>
                                    <input disabled="true" value="{{ Session::get('profile')->description }}" type="text" name="description" class="form-control" id="fullname" placeholder="input your fullname here..">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="username" class="form-label">username</label>
                                    <input disabled="true" value="{{ Session::get('users')->username }}" type="text" name="username" class="form-control" id="fullname" placeholder="input your fullname here..">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
    