@extends('includes.html_structure')

@section('icon', 'add.jpg')

@section('title', 'افزودن دانش آموز')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">افزودن دانش آموز</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-plus"></i>
                        افزودن دانش آموز
                    </div>
                    <div class="card-body" style="direction: rtl;">
                        <form action="{{ route('insert.student') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" name="name" placeholder="نام دانش آموز" value="{{ old('name') }}" class="form-control @if($errors->has('name')) is-invalid @endif">
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span><br>
                            @endif
                            <br>
                            <input type="text" name="username" placeholder="نام کاربری" value="{{ old('username') }}" class="form-control @if($errors->has('username')) is-invalid @endif">
                            @if($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span><br>
                            @endif
                            <br>
                            <input type="password" name="password" placeholder="رمز عبور" class="form-control @if($errors->has('password')) is-invalid @endif">
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span><br>
                            @endif
                            <br>
                            <input type="submit" value="افزودن" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
