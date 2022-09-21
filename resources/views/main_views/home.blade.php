@extends('includes.html_structure')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">داشبورد</h1><br>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-edit"></i>
                                ویرایش موضوع درس
                            </div>
                            <div class="card-body" style="direction: rtl;">
                                @if(isset($_GET['edit-lesson-subject']) && !empty($_GET['edit-lesson-subject']))
                                    <form action="{{ route('update.lesson.subject', ['subject' => $_GET['edit-lesson-subject']]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="put">
                                        <input type="text" name="subject_name" placeholder="عنوان موضوع درس" value="{{ $edit_form_subject_name }}" class="form-control"><br>
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
                                    <form action="{{ route('create-lesson-subject') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="text" name="subject_name" placeholder="عنوان موضوع درس" class="form-control"><br>
                                        <input type="submit" value="افزودن" class="btn btn-success">
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        موضوعات دروس
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان موضوع درس</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach($lessons_subjects as $lesson_subject)
                                    <tr>
                                        <td>@php echo ++$counter; @endphp</td>
                                        <td>{{ $lesson_subject->subject_name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('home') }}?edit-lesson-subject={{ $lesson_subject->id }}" class="btn btn-warning" style="color: white; margin-right: 3px;">ویرایش</a>
                                                <form action="{{ route('delete.lesson.subject', ['subject' => $lesson_subject->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="delete">
                                                    <button class="btn btn-danger" onclick="if(confirm('آیا از حذف این موضوع درس مطمئن هستید؟')){return true;}else{return false;}">حذف</button>
                                                </form>
                                            </div>
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
