@extends('includes.html_structure')

@section('icon', 'add.jpg')

@section('title')
افزودن کار برای: {{ $student->name }}
@endsection

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">افزودن کار</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-plus"></i>
                        افزودن کار برای: {{ $student->name }}
                    </div>
                    <div class="card-body" style="direction: rtl;">
                        <form action="{{ route('insert.student.work', ['student' => $student->id]) }}" method="POST">
                            {{ csrf_field() }}
                            <select name="lesson_subject_id" class="form-control">
                                <option value="">لطفا موضوع درس خود را انتخاب کنید.</option>
                                @foreach($lessons_subjects as $lesson_subject)
                                    <option value="{{ $lesson_subject->id }}">{{ $lesson_subject->subject_name }}</option>                                    
                                @endforeach
                            </select><br>
                            <label for="presence">
                                <input type="checkbox" name="presence" id="presence"> حضور در کلاس
                            </label>
                            <label for="home_work" style="margin-right: 7px;">
                                <input type="checkbox" name="home_work" id="home_work"> انجام تکالیف منزل
                            </label>
                            <label for="class_work" style="margin-right: 7px;">
                                <input type="checkbox" name="class_work" id="class_work"> انجام کار کلاسی
                            </label>
                            <br><br>
                            <input type="number" name="score" placeholder="نمره کلی" class="form-control"><br>
                            <textarea name="description" id="description" rows="15" placeholder="توضیحات (اختیاری)" class="form-control"></textarea><br>
                            <select name="year" class="form-control">
                                <option value="">لطفا سال مورد نظر خود را وارد کنید.</option>
                                <option value="1401">1401</option>
                                <option value="1402">1402</option>
                                <option value="1403">1403</option>
                                <option value="1404">1404</option>
                                <option value="1405">1405</option>
                            </select><br>
                            <select name="month" class="form-control">
                                <option value="">لطفا ماه مورد نظر خود را وارد کنید.</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">@php echo ($i < 10) ? '0' . $i : $i; @endphp</option>
                                @endfor
                            </select><br>
                            <select name="day" class="form-control">
                                <option value="">لطفا روز مورد نظر خود را وارد کنید.</option>
                                @for($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">@php echo ($i < 10) ? '0' . $i : $i; @endphp</option>
                                @endfor
                            </select><br>
                            <input type="submit" value="افزودن" class="btn btn-success">
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
