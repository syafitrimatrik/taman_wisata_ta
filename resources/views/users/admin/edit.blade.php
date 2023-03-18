@extends('layouts/admin/dashboard')

@section('title', 'Dashboard')

@section('content')
    <style>
        .bg-image-thumb {
            height: 175px;
            background-color: rgb(85, 89, 92);
        }

        #images-preview .mb-3 {
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
                <a class="btn btn-primary" href="/dashboard/taman-wisata">Back</a>
            </div>
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Create Data For Taman Wisata</h6>
                    </div>
                    <div class="card-body" style="width: 100%;">
                    <form class="users" action="/dashboard/profile/editPost" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="fullname" class="form-label">fullname</label>
                                <input value="{{ Session::get('profile')->fullname }}" type="text" name="fullname" class="form-control" id="fullname" placeholder="input your fullname here..">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="email" class="form-label">email</label>
                                <input value="{{ Session::get('users')->email }}" type="email" name="email" class="form-control" id="email" placeholder="input your email here..">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="location" class="form-label">location</label>
                                <input value="{{ Session::get('profile')->location }}" type="text" name="location" class="form-control" id="location" placeholder="input your location here..">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="description" class="form-label">description</label>
                                <input value="{{ Session::get('profile')->description }}" type="text" name="description" class="form-control" id="description" placeholder="input your description here..">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="images_profile" class="form-label">images_profile</label>
                                <input placeholder="{{ Session::get('profile')->images_profile }}" value="{{ Session::get('profile')->images_profile }}" type="file" name="images_profile" class="form-control" id="images_profile" placeholder="input your images_profile here..">
                            </div>
                        </div>
                        <input name="user_id" value="{{ Session::get('profile')->id }}" style="visibility: hidden;" >
                        <input name="image_default" value="{{ Session::get('profile')->images }}" style="visibility: hidden;" >
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

    <script>
        $("#add-images").on('click', function() {
            $("#images-preview").append(`
                <div class="mb-3">
                    <input type="file" name="images[]" class="form-control" id="images" placeholder="input your images here..">
                    <div class="ml-2 btn btn-danger" id="btn-delete-more">-</div>
                </div>
            `)
        })

        $("#add-images-link").on('click', function() {
            $("#images-preview").append(`
                <div class="mb-3">
                    <input type="text" name="imageslink[]" class="form-control" id="imageslink" placeholder="input your images here..">
                    <div class="ml-2 btn btn-danger" id="btn-delete-more-link">-</div>
                </div>
            `)
        })

        $(document).on('click','#btn-delete-more',function(){
            $(this).parent().remove()
        });

        $(document).on('click','#btn-delete-more-link',function(){
            $(this).parent().remove()
        });

        $("#maps").on('input', function(e) {
            $('#maps-show').html(e.target.value)
        })
    </script>
@endsection
    