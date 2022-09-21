<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ env('APP_NAME') }} | ورود</title>
        <link rel="icon" href="{{ asset('images/icons/login.png') }}">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"><a href="{{ route('home') }}" style="text-decoration: none;">{{ env('APP_NAME') }}</a> | ورود</h3></div>
                                    <div class="card-body">
                                        <form action="/login" method="POST">
                                            {{ csrf_field() }}

                                            @if($errors->has('username'))
                                                <div class="alert alert-danger">{{ $errors->first('username') }}</div>
                                            @endif

                                            @if($errors->has('password'))
                                                <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                                            @endif
                                            
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="username" name="username" type="text" placeholder="نام کاربری" value="{{ old('username') }}" />
                                                <label for="username">نام کاربری</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" name="password" type="password" placeholder="رمز عبور" value="{{ old('password') }}" />
                                                <label for="password">رمز عبور</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="remember" name="remember" type="checkbox" />
                                                <label class="form-check-label" for="remember" style="direction: rtl;"><b>مرا به خاطر بسپار!</b></label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input type="submit" value="ورود" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
