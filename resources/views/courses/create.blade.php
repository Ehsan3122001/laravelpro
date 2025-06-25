@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">إضافة دورة جديدة</h2>

    <form method="POST" action="{{ route('courses.store') }}">
        @csrf

        <div class="form-group">
            <label>اسم الدورة</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>السعر</label>
            <input type="number" name="cost" class="form-control" required>
        </div>

        <div class="form-group">
            <label>ID المعلم</label>
            <input type="number" name="teacher_id" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-2">حفظ</button>
    </form>
</div>
@endsection
