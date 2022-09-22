@extends('includes.html_structure')

@section('icon', 'edit.png')

@section('title')
ویرایش دانش آموز: {{ $student->name }}
@endsection

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">ویرایش دانش آموز</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-edit"></i>
                        ویرایش دانش آموز: {{ $student->name }}
                    </div>
                    <div class="card-body" style="direction: rtl;">
                        <form action="{{ route('update.student', ['student' => $student->id]) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <input type="text" name="name" placeholder="نام دانش آموز" value="@if(empty(old('name'))){{ $student->name }}@else{{ old('name') }}@endif" class="form-control @if($errors->has('name')) is-invalid @endif">
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span><br>
                            @endif
                            <br>
                            <input type="text" name="username" placeholder="نام کاربری" value="@if(empty(old('username'))){{ $student->username }}@else{{ old('username') }}@endif" class="form-control @if($errors->has('username')) is-invalid @endif">
                            @if($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span><br>
                            @endif
                            <br>
                            <input type="password" name="password" placeholder="رمز عبور" class="form-control @if($errors->has('password')) is-invalid @endif">
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span><br>
                            @endif
                            <br>
                            <label for="old_image">تصویر قبلی دانش آموز:</label><br><br>
                            <img src="{{ asset('images/students_images/' . $student->image) }}" id="old_image" alt="تصویری به نمایش در نیامد." style="width: 100%; height: 300px; border: none; border-radius: 5px;"><br><br>
                            <div class="mb-3">
                                <label for="image" class="form-label">در صورت تمایل، تصویر جدیدی برای این دانش آموز، وارد کنید.</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <br>
                            <input type="submit" value="ویرایش" class="btn btn-warning" style="color: white;">
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
