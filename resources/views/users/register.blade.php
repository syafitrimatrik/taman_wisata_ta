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
                                        <form class="users" action="/register" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">username</label>
                                                    <input type="text" name="username" class="form-control" id="username" placeholder="input your username here..">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">password</label>
                                                    <input type="password" name="password" class="form-control" id="password" placeholder="input your password here..">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">email</label>
                                                    <input type="email" name="email" class="form-control" id="email" placeholder="input your email here..">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="mb-3">
                                                    <label for="fullname" class="form-label">fullname</label>
                                                    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="input your fullname here..">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Register
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