@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Course</h2>

    <form method="POST" action="{{ route('courses.update', $course->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Course Name</label>
            <input type="text" name="name" value="{{ $course->name }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Cost</label>
            <input type="number" name="cost" value="{{ $course->cost }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Teacher</label>
            <select name="teacher_id" class="form-control" required>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ $course->teacher_id == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Course</button>
    </form>
</div>
@endsection
