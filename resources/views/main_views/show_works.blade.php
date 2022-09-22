@extends('includes.html_structure')

@section('icon', 'panel.jpg')

@section('title')
مشاهده کارهای: {{ $student->name }}
@endsection

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">مشاهده کارها</h1><br>
                @foreach($flashed_messages as $message_type => $message_text)
                    <div class="alert alert-{{ $message_type }}" style="direction: rtl;">{{ $message_text }}</div>
                @endforeach
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-tasks"></i>
                        مشاهده کارهای: {{ $student->name }}
                    </div>
                    <div class="card-body">
                        <a href="#" class="btn btn-success" style="float: right;">ثبت کار جدید</a><br><br>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام درس</th>
                                    <th>نمره کلی</th>
                                    <th>تاریخ</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $worksCounter = 0;
                                @endphp
                                @foreach($works as $work)
                                    <tr>
                                        <td>@php echo ++$worksCounter; @endphp</td>
                                        <td>{{ $work->lesson_subject->subject_name }}</td>
                                        <td>{{ $work->score }}</td>
                                        <td>{{ $work->year }} / @if($work->month < 10)0{{ $work->month }}@else{{ $work->month }}@endif / @if($work->day < 10)0{{ $work->day }}@else{{ $work->day }}@endif</td>
                                        <td>
                                            <a href="#" class="btn btn-warning" style="color: white;">ویرایش</a>
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
