<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{__("admin.login")}}</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset("admin")}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset("admin")}}/css/rtl/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center" style="margin-top: 60px">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5" style="max-width: 600px;margin-top: 60px; margin: auto;}">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="">
                        <div class="" style="max-width: 500px; margin: auto">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    @if(session()->has("failed"))
                                        <p class="text-danger">{{session("failed")}}</p>
                                    @endif
                                </div>
                                <form class="user" method="POST" action="{{route("admin.login")}}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="{{__("admin.email")}}">
                                        @if($errors->has('email'))
                                            <p class="text-danger text-uppercase">{{$errors->first('email')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="{{__("admin.password")}}">
                                        @if($errors->has('password'))
                                            <p class="text-danger text-uppercase">{{$errors->first('password')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">{{__("admin.remember")}}</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{__("admin.login")}}
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

<!-- Bootstrap core JavaScript-->
<script src="{{asset("admin")}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset("admin")}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset("admin")}}/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset("backend")}}/js/sb-admin-2.min.js"></script>

</body>

</html>
