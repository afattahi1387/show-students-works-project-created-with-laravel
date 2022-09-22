@extends('includes.users_dashboard_html_structure')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">داشبورد</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-tasks"></i>
                        مشاهده کارهای: {{ auth()->user()->name }}
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام درس</th>
                                    <th>نمره کلی</th>
                                    <th>فعالیت دانش آموز</th>
                                    <th>توضیحات</th>
                                    <th>تاریخ</th>
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
                                        <td>
                                            <label for="presence">
                                                <input type="checkbox" id="presence" @if($work->presence) checked @endif>حضور و غیاب
                                            </label><br>
                                            <label for="home_work">
                                                <input type="checkbox" id="home_work" @if($work->home_work) checked @endif>انجام تکالیف منزل
                                            </label><br>
                                            <label for="class_work">
                                                <input type="checkbox" id="class_work" @if($work->class_work) checked @endif>انجام کار کلاسی
                                            </label>
                                        </td>
                                        <td style="direction: rtl;">{!! $work->description !!}</td>
                                        <td>{{ $work->year }} / @if($work->month < 10)0{{ $work->month }}@else{{ $work->month }}@endif / @if($work->day < 10)0{{ $work->day }}@else{{ $work->day }}@endif</td>
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
