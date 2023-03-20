<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Devi Eye Hospital - Order Management System">
    <meta name="keyword" content="Devi Eye Hospital - Order Management System">
    <title>Devi Eye Hospital - Login</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->

    <!-- project css file  -->
    <link rel="stylesheet" href="{{ asset('assets/css/al.style.min.css') }}">
    <!-- project layout css file -->
    <link rel="stylesheet" href="{{ asset('assets/css/layout.q.min.css') }}">
</head>

<body>

<div id="layout-q" class="theme-green">

    <!-- main body area -->
    <div class="main auth-div p-2 py-3 p-xl-5">
        
        <!-- Body: Body -->
        <div class="body d-flex p-0 p-xl-5">
            <div class="container-fluid">

                <div class="row g-0">
                    <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                        <div class="w-100 p-4 p-md-5 card border-0" style="max-width: 32rem;">
                            <!-- Form -->
                            <form class="row g-1 p-0 p-md-4" method="post" action="{{ route('login') }}">
                                @csrf
                                <div class="col-12 text-center mb-5">
                                    <h1>Sign in</h1>
                                    <span>Devi Eye Hospitals - Order Management System.</span>
                                </div>
                                @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif
                                @if(session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Email address</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com">
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <div class="form-label">
                                            <span class="d-flex justify-content-between align-items-center">
                                                Password
                                            </span>
                                        </div>
                                        <input type="password" class="form-control" name="password" placeholder="***************">
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ $errors->first('password') }}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-submit btn-block btn-primary lift text-uppercase">SIGN IN</button>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                </div> <!-- End Row -->
                
            </div>
        </div>

    </div>

</div>

<!-- Jquery Core Js -->
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>

<!-- Jquery Page Js -->
<script src="{{ asset('assets/js/template.js') }}"></script>
<script>
    $(function(){
        "use strict"
        $('form').submit(function(){
            $(".btn-submit").attr("disabled", true);
            $(".btn-submit").html("<span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span>");
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    setTimeout(function () {
        $(".alert").hide('slow');
    }, 3000);
</script>
</body>
</html>