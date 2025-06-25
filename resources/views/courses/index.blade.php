@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">قائمة الدورات</h2>

    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">إضافة دورة جديدة</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>السعر</th>
                <th>المعلم</th>
                <th>التحكم</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->name }}</td>
                <td>{{ $course->cost }}</td>
                <td>{{ $course->teacher_id }}</td>
                <td>
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
