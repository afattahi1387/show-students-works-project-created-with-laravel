@extends('includes.html_structure')

@section('icon', 'panel.jpg')

@section('title', 'دانش آموزان')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">دانش آموزان</h1><br>
                @foreach($flashed_messages as $message_type => $message_text)
                    <div class="alert alert-{{ $message_type }}" style="direction: rtl;">{{ $message_text }}</div>
                @endforeach
                {{-- <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-edit"></i>
                                ویرایش موضوع درس
                            </div>
                            <div class="card-body" style="direction: rtl;">
                                @if(isset($_GET['edit-student']) && !empty($_GET['edit-lesson-subject']))
                                    <form action="" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="put">
                                        <input type="text" name="subject_name" placeholder="عنوان موضوع درس" value="" class="form-control"><br>
                                        <input type="submit" value="ویرایش" class="btn btn-warning" style="color: white;">
                                    </form>
                                @else
                                    <span class="text-danger">فرم ویرایش موضوع درس غیرفعال است؛ برای ویرایش موضوع درس، روی دکمه ویرایش در جدول زیر کلیک کنید.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-plus"></i>
                                افزودن موضوع درس
                            </div>
                            <div class="card-body" style="direction: rtl;">
                                @if(isset($_GET['edit-lesson-subject']) && !empty($_GET['edit-lesson-subject']))
                                    <span class="text-danger">فرم افزودن موضوع درس غیرفعال است؛ چون صفحه در وضعیت ویرایش موضوع درس قرار دارد.</span>
                                @else
                                    <form action="" method="POST">
                                        {{ csrf_field() }}
                                        <input type="text" name="subject_name" placeholder="عنوان موضوع درس" class="form-control"><br>
                                        <input type="submit" value="افزودن" class="btn btn-success">
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-graduation-cap"></i>
                        دانش آموزان
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام دانش آموز</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $studentsCounter = 0;
                                @endphp
                                @foreach($students as $student)
                                    <tr>
                                        <td>@php echo ++$studentsCounter; @endphp</td>
                                        <td>{{ $student->name }}</td>
                                        <td>
                                            <a href="{{ route('show.works', ['student' => $student->id]) }}" class="btn btn-primary">مشاهده کارها</a>
                                            <a href="{{ route('edit.student', ['student' => $student->id]) }}" class="btn btn-warning" style="color: white;">ویرایش</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
