@extends('layouts/main')

@section('title', 'Taman Wisata')

@section('content')
    <style>
        #login-page {
            padding: 5%;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        .bg-login-image {
            background-image: url('https://nyero.id/wp-content/uploads/2018/01/Tempat-Wisata-di-Magelang-Terbaru.png') !important;
        }
    </style>
    <section id="login-page">
        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        </div>
                                        <form class="user" action="/login" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user"
                                                    id="username" aria-describedby="username"
                                                    placeholder="Enter Email Address..." name="username">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    id="exampleInputPassword" placeholder="Password" name="password">
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection
    