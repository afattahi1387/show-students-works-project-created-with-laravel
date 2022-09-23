@extends('includes.html_structure')

@section('icon', 'edit.png')

@section('title')
ویرایش کار مربوط به موضوع درس: {{ $work->lesson_subject->subject_name }}
@endsection

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">ویرایش کار</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-edit"></i>
                        ویرایش کار مربوط به موضوع درس: {{ $work->lesson_subject->subject_name }}
                    </div>
                    <div class="card-body" style="direction: rtl;">
                        <form action="{{ route('update.student.work', ['work' => $work->id]) }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <select name="lesson_subject_id" class="form-control">
                                @foreach($lessons_subjects as $lesson_subject)
                                    @if(!empty(old('lesson_subject_id')))
                                        <option value="{{ $lesson_subject->id }}" selected>{{ $lesson_subject->subject_name }}</option>
                                    @else
                                        @if($lesson_subject->id == $work->lesson_subject_id)
                                            <option value="{{ $lesson_subject->id }}" selected>{{ $lesson_subject->subject_name }}</option>
                                        @else
                                            <option value="{{ $lesson_subject->id }}">{{ $lesson_subject->subject_name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select><br>
                            <label for="presence">
                                <input type="checkbox" name="presence" id="presence" @if($work->presence) checked @endif> حضور در کلاس
                            </label>
                            <label for="presence" style="margin-right: 7px;">
                                <input type="checkbox" name="home_work" id="home_work" @if($work->home_work) checked @endif> انجام تکالیف منزل
                            </label>
                            <label for="presence" style="margin-right: 7px;">
                                <input type="checkbox" name="class_work" id="class_work" @if($work->class_work) checked @endif> انجام کار کلاسی
                            </label><br><br>
                            <input type="number" name="score" placeholder="نمره کلی" value="@if(empty(old('score'))){{ $work->score }}@else{{ old('score') }}@endif" class="form-control"><br>
                            <textarea name="description" id="description" rows="15" placeholder="توضیحات (اختیاری)" class="form-control">@if(empty(old('description'))){{ $work->description }}@else{{ old('description') }}@endif</textarea><br>
                            <select name="year" class="form-control">
                                @if(!empty(old('year')))
                                    <option value="{{ old('year') }}" selected>{{ old('year') }}</option>
                                @else
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($work->year == '140' . $i)
                                            <option value="{{ '140' . $i }}" selected>{{ '140' . $i }}</option>
                                        @else
                                            <option value="{{ '140' . $i }}">{{ '140' . $i }}</option>
                                        @endif
                                    @endfor
                                @endif
                            </select><br>
                            <select name="month" class="form-control">
                                @for($i = 1; $i <= 12; $i++)
                                    @if(!empty(old('month')) && $i == old('month'))
                                        <option value="{{ $i }}" selected>@php echo ($i < 10) ? '0' . $i : $i; @endphp</option>
                                    @else
                                        @if($work->month == $i)
                                            <option value="{{ $i }}" selected>@php echo ($i < 10) ? '0' . $i : $i; @endphp</option>
                                        @else
                                            <option value="{{ $i }}">@php echo ($i < 10) ? '0' . $i : $i; @endphp</option>
                                        @endif
                                    @endif
                                @endfor
                            </select><br>
                            <select name="day" class="form-control">
                                @for($i = 1; $i <= 31; $i++)
                                    @if(!empty(old('day')) && $i == old('day'))
                                        <option value="{{ $i }}" selected>@php echo ($i < 10) ? '0' . $i : $i; @endphp</option>
                                    @else
                                        @if($work->day == $i)
                                            <option value="{{ $i }}" selected>@php echo ($i < 10) ? '0' . $i : $i; @endphp</option>
                                        @else
                                            <option value="{{ $i }}">@php echo ($i < 10) ? '0' . $i : $i; @endphp</option>
                                        @endif
                                    @endif
                                @endfor
                            </select><br>
                            <input type="submit" value="ویرایش" class="btn btn-warning" style="color: white;">
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
      tinymce.init({
        selector: '#description',
        directionality: 'rtl',
        plugins: [
          'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
          'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
          'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
      });
    </script>
@endsection
