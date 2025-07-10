@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New Course</h2>

    <form method="POST" action="{{ route('courses.store') }}">
        @csrf

        <div class="form-group mb-3">
            <label>Course Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Cost</label>
            <input type="number" name="cost" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="" disabled selected>Choose Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Teacher</label>
            <select name="teacher_id" class="form-control" required>
                <option value="" disabled selected>Choose Teacher</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save Course</button>
    </form>
</div>
@endsection
