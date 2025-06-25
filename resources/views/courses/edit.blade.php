@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">تعديل دورة</h2>

    <form method="POST" action="{{ route('courses.update', $course->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>اسم الدورة</label>
            <input type="text" name="name" value="{{ $course->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>السعر</label>
            <input type="number" name="cost" value="{{ $course->cost }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>ID المعلم</label>
            <input type="number" name="teacher_id" value="{{ $course->teacher_id }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">تحديث</button>
    </form>
</div>
@endsection
